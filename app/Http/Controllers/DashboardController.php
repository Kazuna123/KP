<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\Kendaraan;
use App\Models\Transaksi;
use App\Models\PencatatanTanggal;

class DashboardController extends Controller
{
    public function index()
    {
        // Hitung data untuk ringkasan
        $totalPegawai = Pegawai::count();
        $totalKendaraan = Kendaraan::count();
        $totalTransaksi = Transaksi::count();
        $totalPencatatan = PencatatanTanggal::count();

        // Kirim data ke view
        return view('dashboard', compact(
            'totalPegawai',
            'totalKendaraan',
            'totalTransaksi',
            'totalPencatatan'
        ));
    }
}
