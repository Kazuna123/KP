<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use App\Models\Pegawai;
use App\Models\ArsipSurat;
use Illuminate\Http\Request;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

use Barryvdh\DomPDF\Facade\Pdf;

class KendaraanController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->query('q');

        $kendaraans = Kendaraan::with('pegawai')
            ->when($q, function($query) use ($q) {
                $query->where('nomor_polisi', 'like', "%$q%")
                    ->orWhere('merk', 'like', "%$q%")
                    ->orWhere('tipe', 'like', "%$q%")
                    ->orWhereHas('pegawai', function($p) use ($q){
                        $p->where('nama','like',"%$q%")
                          ->orWhere('nip','like',"%$q%");
                    });
            })
            ->orderBy('id','desc')
            ->paginate(12);

        $pegawais = Pegawai::orderBy('nama')->get();
        $sekretaris = ['Sekretaris A','Sekretaris B','Sekretaris C'];

        return view('kendaraan.index', compact('kendaraans','sekretaris','pegawais','q'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'jenis' => 'required|string|max:50',
            'nomor_polisi' => 'required|string|max:50',
            'merk' => 'required|string|max:100',
            'tipe' => 'nullable|string|max:100',
            'tahun' => 'nullable|integer',
            'nomor_rangka' => 'nullable|string',
            'nomor_mesin' => 'nullable|string',
            'status' => 'required|in:tersedia,dipinjam,maintenance',
        ]);

        Kendaraan::create($validated);

        return redirect()->route('kendaraan.index')
            ->with('success','Data kendaraan berhasil ditambahkan!');
    }



    public function edit($id)
    {
        $kendaraan = Kendaraan::findOrFail($id);

        return view('kendaraan.edit', compact('kendaraan'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'jenis' => 'required',
            'nomor_polisi' => 'required',
            'merk' => 'required',
            'tipe' => 'required',
            'tahun' => 'required|numeric',
            'nomor_rangka' => 'nullable',
            'nomor_mesin' => 'nullable',
            'status' => 'required',
        ]);

        $kendaraan = Kendaraan::findOrFail($id);
        $kendaraan->update($validated);

        return redirect()->route('kendaraan.index')->with('success', 'Data kendaraan berhasil diperbarui!');
    }


    public function destroy(Kendaraan $kendaraan)
    {
        $kendaraan->delete();

        return redirect()->route('kendaraan.index')
            ->with('success','Data kendaraan berhasil dihapus.');
    }

    /* ============================================================
     *  CETAK PDF PEMUTIHAN
     * ============================================================ */
    public function cetakPemutihan(Request $request, Kendaraan $kendaraan)
    {
        $request->validate([
            'nomor_surat' => 'required',
            'tanggal_surat' => 'required|date',
            'sekretaris' => 'required'
        ]);

        $data = [
            'kendaraan' => $kendaraan->load('pegawai'),
            'nomor_surat' => $request->nomor_surat,
            'tanggal_surat' => $request->tanggal_surat,
            'sekretaris' => $request->sekretaris
        ];

        $pdf = Pdf::loadView('pdf.surat_pemutihan', $data)->setPaper('A4', 'portrait');
        return $pdf->stream('surat_pemutihan_'.$kendaraan->nomor_polisi.'.pdf');
    }


    /* ============================================================
     *  CETAK PDF SPBKB
     * ============================================================ */
    public function cetakSpbkb(Request $request, Kendaraan $kendaraan)
    {
        $request->validate([
            'nomor_surat' => 'required',
            'tanggal_surat' => 'required|date',
            'sekretaris' => 'required'
        ]);

        $data = [
            'kendaraan' => $kendaraan->load('pegawai'),
            'nomor_surat' => $request->nomor_surat,
            'tanggal_surat' => $request->tanggal_surat,
            'sekretaris' => $request->sekretaris
        ];

        $pdf = Pdf::loadView('pdf.spbkb', $data)->setPaper('A4', 'portrait');
        return $pdf->stream('spbkb_'.$kendaraan->nomor_polisi.'.pdf');
    }
}
