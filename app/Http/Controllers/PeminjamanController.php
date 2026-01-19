<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Pegawai;
use App\Models\Kendaraan;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf; // pastikan package dompdf terpasang
use App\Exports\PeminjamanExport;
use Maatwebsite\Excel\Facades\Excel;

class PeminjamanController extends Controller
{
    public function export()
    {
        return Excel::download(
            new PeminjamanExport,
            'data_peminjaman.xlsx'
        );
    }

    public function index(Request $request)
    {
        $q = $request->query('q');

        $peminjamans = Peminjaman::with(['pegawai','kendaraan'])
            ->when($q, function($query,$q){
                $query->whereHas('pegawai', function($qq) use ($q){
                    $qq->where('nama','like',"%$q%")->orWhere('nip','like',"%$q%");
                })->orWhereHas('kendaraan', function($qq) use ($q){
                    $qq->where('nomor_polisi','like',"%$q%")->orWhere('merk','like',"%$q%");
                });
            })
            ->orderBy('id','desc')
            ->paginate(12);

        $pegawais = Pegawai::orderBy('nama')->get();
        $kendaraans = Kendaraan::orderBy('nomor_polisi')->get();

        return view('peminjaman.index', compact('peminjamans','pegawais','kendaraans','q'));
    }

    public function create()
    {
        $pegawais = Pegawai::orderBy('nama')->get();
        $kendaraans = Kendaraan::orderBy('nomor_polisi')->get();
        return view('peminjaman.create', compact('pegawais','kendaraans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pegawai_id' => 'required|exists:pegawai,id',
            'kendaraan_id' => 'required|exists:kendaraan,id',
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'nullable|date|after_or_equal:tanggal_pinjam',
            'keterangan' => 'nullable|string',
        ]);

        // cek ketersediaan kendaraan
        $kend = Kendaraan::find($request->kendaraan_id);
        if(!$kend || $kend->status !== 'tersedia'){
            return back()->withErrors(['kendaraan_id' => 'Kendaraan tidak tersedia untuk dipinjam'])->withInput();
        }

        $p = Peminjaman::create([
            'pegawai_id' => $request->pegawai_id,
            'kendaraan_id' => $request->kendaraan_id,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'tanggal_kembali' => $request->tanggal_kembali,
            'keterangan' => $request->keterangan,
            'status' => 'dipinjam',
            'user_id' => auth()->id(),
        ]);

        // update status kendaraan
        $kend->status = 'dipinjam';
        $kend->save();

        return redirect()->route('peminjaman.index')->with('success','Peminjaman berhasil ditambahkan.');
    }

    public function show(Peminjaman $peminjaman)
    {
        return redirect()->route('peminjaman.index');
    }

    public function edit(Peminjaman $peminjaman)
    {

        $pegawai = Pegawai::all();
        $kendaraan = Kendaraan::all();

        return view('peminjaman.edit', compact('peminjaman', 'pegawai', 'kendaraan'));
    }

    public function update(Request $request, Peminjaman $peminjaman)
    {
        $request->validate([
            'pegawai_id' => 'required|exists:pegawai,id',
            'kendaraan_id' => 'required|exists:kendaraan,id',
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'nullable|date|after_or_equal:tanggal_pinjam',
            'keterangan' => 'nullable|string',
        ]);

        $oldKendaraanId = $peminjaman->kendaraan_id;

        // jika kendaraan baru tidak tersedia -> error
        $newKend = Kendaraan::find($request->kendaraan_id);
        if($oldKendaraanId != $request->kendaraan_id){
            if(!$newKend || $newKend->status !== 'tersedia'){
                return back()->withErrors(['kendaraan_id' => 'Kendaraan baru tidak tersedia'])->withInput();
            }
        }

        $peminjaman->update([
            'pegawai_id' => $request->pegawai_id,
            'kendaraan_id' => $request->kendaraan_id,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'tanggal_kembali' => $request->tanggal_kembali,
            'keterangan' => $request->keterangan,
        ]);

        // update status kendaraan lama/baru bila berubah
        if($oldKendaraanId != $request->kendaraan_id){
            if($old = Kendaraan::find($oldKendaraanId)){
                $old->status = 'tersedia';
                $old->save();
            }
            if($new = Kendaraan::find($request->kendaraan_id)){
                $new->status = 'dipinjam';
                $new->save();
            }
        }

        return redirect()->route('peminjaman.index')->with('success','Peminjaman diperbarui.');
    }

    public function destroy(Peminjaman $peminjaman)
    {
        // kembalikan status kendaraan jika sedang dipinjam
        $kend = $peminjaman->kendaraan;
        if($kend){
            $kend->status = 'tersedia';
            $kend->save();
        }

        $peminjaman->delete();
        return redirect()->route('peminjaman.index')->with('success','Peminjaman dihapus.');
    }

    public function selesai(Request $request, Peminjaman $peminjaman)
    {
        $request->validate([
            'tanggal_kembali' => 'nullable|date',
        ]);

        $peminjaman->update([
            'status' => 'selesai',
            'tanggal_kembali' => $request->tanggal_kembali ?? now()
        ]);

        $kend = $peminjaman->kendaraan;
        if($kend){
            $kend->status = 'tersedia';
            $kend->save();
        }

        return redirect()->route('peminjaman.index')->with('success','Peminjaman ditandai selesai.');
    }

    public function batal(Request $request, Peminjaman $peminjaman)
    {
        $peminjaman->update(['status'=>'dibatalkan']);
        $kend = $peminjaman->kendaraan;
        if($kend){
            $kend->status = 'tersedia';
            $kend->save();
        }
        return redirect()->route('peminjaman.index')->with('success','Peminjaman dibatalkan.');
    }

    public function cetak(Request $request, Peminjaman $peminjaman)
    {
        $request->validate([
        'nomor_surat' => 'nullable|string',
        'tanggal_surat' => 'nullable|date',
        'sekretaris' => 'nullable|string',
    ]);

    $data = [
        'pm' => $peminjaman->load('pegawai','kendaraan'),
        'nomor_surat' => $request->nomor_surat,
        'tanggal_surat' => $request->tanggal_surat,
        'sekretaris' => $request->sekretaris,
    ];

    $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('pdf.peminjaman', $data)
            ->setPaper('A4', 'portrait');

    return $pdf->stream('peminjaman_'.$peminjaman->id.'.pdf');
    }
}
