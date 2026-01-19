<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\Kendaraan;
use App\Models\Peminjaman;
use App\Models\PajakKendaraan;
use Carbon\Carbon;

class DashboardController extends Controller
{

    public function index()
    {
        $today = Carbon::today();
    
        return view('dashboard', [
            'totalPegawai'    => Pegawai::count(),
            'totalKendaraan'  => Kendaraan::count(),
            'totalPeminjaman' => Peminjaman::count(),
    
            // STATUS KENDARAAN
            'kendaraanAktif'       => Kendaraan::where('status', 'tersedia')->count(),
            'kendaraanDipinjam'    => Kendaraan::where('status', 'dipinjam')->count(),
            'kendaraanMaintenance' => Kendaraan::where('status', 'maintenance')->count(),
    
            // PAJAK
            'pajakKadaluarsa' => PajakKendaraan::where('tanggal_jatuh_tempo', '<', $today)->count(),
    
            'pajakH30' => PajakKendaraan::whereBetween(
                'tanggal_jatuh_tempo',
                [$today, $today->copy()->addDays(30)]
            )->count(),
        ]);
    }
}
