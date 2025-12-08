<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Pegawai;
use App\Models\Kendaraan;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    /**
     * Tampilkan semua transaksi
     */
    public function index()
    {
        $transaksis = Transaksi::with(['pegawai', 'kendaraan'])->get();
        return view('transaksi.index', compact('transaksis'));
    }

    /**
     * Tampilkan form tambah transaksi
     */
    public function create()
    {
        $pegawais = Pegawai::all();
        $kendaraans = Kendaraan::all();
        return view('transaksi.create', compact('pegawais', 'kendaraans'));
    }

    /**
     * Simpan data transaksi baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'pegawai_id' => 'required|exists:pegawai,id',
            'kendaraan_id' => 'required|exists:kendaraan,id',
            'jenis' => 'required|in:pinjam,servis',
            'tujuan' => 'nullable|string',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'nullable|date',
            'status' => 'required|in:ongoing,selesai,dibatalkan',
            'keterangan' => 'nullable|string',
        ]);

        Transaksi::create($request->all());

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil ditambahkan.');
    }

    /**
     * Tampilkan form edit transaksi
     */
    public function edit($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $pegawais = Pegawai::all();
        $kendaraans = Kendaraan::all();

        return view('transaksi.edit', compact('transaksi', 'pegawais', 'kendaraans'));
    }

    /**
     * Update data transaksi
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'pegawai_id' => 'required|exists:pegawai,id',
            'kendaraan_id' => 'required|exists:kendaraan,id',
            'jenis' => 'required|in:pinjam,servis',
            'tujuan' => 'nullable|string',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'nullable|date',
            'status' => 'required|in:ongoing,selesai,dibatalkan',
            'keterangan' => 'nullable|string',
        ]);

        $transaksi = Transaksi::findOrFail($id);
        $transaksi->update($request->all());

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil diperbarui.');
    }

    /**
     * Hapus transaksi
     */
    public function destroy($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->delete();

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil dihapus.');
    }
}
