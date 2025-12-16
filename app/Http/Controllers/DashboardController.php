<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\Kendaraan;
use App\Models\Peminjaman;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPegawai = Pegawai::count();
        $totalKendaraan = Kendaraan::count();
        $totalTransaksi = Peminjaman::count(); // <- PERBAIKI DISINI
        $totalPencatatan = 0; // Jika nanti ada fitur lain

        return view('dashboard', compact(
            'totalPegawai',
            'totalKendaraan',
            'totalTransaksi'
        ));
    }
}
