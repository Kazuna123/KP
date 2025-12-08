<?php

namespace App\Http\Controllers;

use App\Models\PencatatanTanggal;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class PencatatanTanggalController extends Controller
{
    /**
     * Menampilkan semua data pencatatan.
     */
    public function index()
    {
        $pencatatans = PencatatanTanggal::with('transaksi')->latest()->get();
        return view('pencatatan.index', compact('pencatatans'));
    }

    /**
     * Form tambah pencatatan.
     */
    public function create()
    {
        $transaksis = Transaksi::all(); // biar user bisa pilih transaksi
        return view('pencatatan.create', compact('transaksis'));
    }

    /**
     * Simpan data baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'transaksi_id' => 'required|exists:transaksi,id',
            'tanggal' => 'required|date',
            'catatan' => 'nullable|string',
        ]);

        PencatatanTanggal::create($request->all());

        return redirect()->route('pencatatan.index')->with('success', 'Pencatatan berhasil ditambahkan!');
    }

    /**
     * Form edit pencatatan.
     */
    public function edit($id)
    {
        $pencatatan = PencatatanTanggal::findOrFail($id);
        $transaksis = Transaksi::all();
        return view('pencatatan.edit', compact('pencatatan', 'transaksis'));
    }

    /**
     * Update data pencatatan.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'transaksi_id' => 'required|exists:transaksi,id',
            'tanggal' => 'required|date',
            'catatan' => 'nullable|string',
        ]);

        $pencatatan = PencatatanTanggal::findOrFail($id);
        $pencatatan->update($request->all());

        return redirect()->route('pencatatan.index')->with('success', 'Pencatatan berhasil diperbarui!');
    }

    /**
     * Hapus data pencatatan.
     */
    public function destroy($id)
    {
        $pencatatan = PencatatanTanggal::findOrFail($id);
        $pencatatan->delete();

        return redirect()->route('pencatatan.index')->with('success', 'Pencatatan berhasil dihapus!');
    }
}
