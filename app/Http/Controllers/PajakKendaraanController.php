<?php

namespace App\Http\Controllers;

use App\Models\PajakKendaraan;
use App\Models\Kendaraan;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PajakKendaraanController extends Controller
{
    public function index(Request $request)
    {
        $kendaraanId = $request->kendaraan_id;

        // Dropdown kendaraan
        $kendaraans = Kendaraan::orderBy('merk')->get();

        // Kendaraan terpilih (optional)
        $kendaraan = null;
        if ($kendaraanId) {
            $kendaraan = Kendaraan::findOrFail($kendaraanId);
        }

        // Data pajak
        $pajaks = PajakKendaraan::with('kendaraan')
            ->when($kendaraanId, function ($query) use ($kendaraanId) {
                $query->where('kendaraan_id', $kendaraanId);
            })
            ->orderBy('tanggal_jatuh_tempo', 'desc')
            ->get();

        return view('pajak.index', compact(
            'kendaraans',
            'kendaraan',
            'pajaks'
        ));
    }

    /**
     * Simpan data pajak kendaraan
     */
    public function store(Request $request)
    {
        $request->validate([
            'kendaraan_id'  => 'required|exists:kendaraan,id',
            'jenis'         => 'required|in:tahunan,lima_tahunan',
            'tanggal_bayar' => 'required|date',
        ]);

        // 1. Ambil tanggal bayar
        $tanggalBayar = Carbon::createFromFormat('Y-m-d', $request->tanggal_bayar);

        // 2. Hitung jatuh tempo
        if ($request->jenis === 'tahunan') {
            $tanggalJatuhTempo = $tanggalBayar->copy()->addYear();
        } else {
            $tanggalJatuhTempo = $tanggalBayar->copy()->addYears(5);
        }

        // 3. Simpan ke database
        PajakKendaraan::create([
            'kendaraan_id'        => $request->kendaraan_id,
            'jenis'               => $request->jenis,
            'tanggal_bayar'       => $tanggalBayar,
            'tanggal_jatuh_tempo' => $tanggalJatuhTempo,
        ]);

        return back()->with('success', 'Pajak berhasil disimpan');
    }

    public function edit($id)
    {
        $pajak = PajakKendaraan::findOrFail($id);

        return view('pajak.edit', compact('pajak'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'jenis' => 'required',
            'tanggal_bayar' => 'required|date',
            'tanggal_jatuh_tempo' => 'required|date|after:tanggal_bayar',
        ]);

        $pajak = PajakKendaraan::findOrFail($id);

        $pajak->update([
            'jenis' => $request->jenis,
            'tanggal_bayar' => $request->tanggal_bayar,
            'tanggal_jatuh_tempo' => $request->tanggal_jatuh_tempo,
        ]);

        return redirect()
            ->route('pajak.index', ['kendaraan_id' => $pajak->kendaraan_id])
            ->with('success', 'Data pajak berhasil diperbarui');
    }


    /**
     * Hapus data pajak kendaraan
     */
    public function destroy($id)
    {
        PajakKendaraan::findOrFail($id)->delete();

        return back()->with('success', 'Data pajak kendaraan berhasil dihapus');
    }
}
