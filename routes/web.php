<?php

use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\{
    ProfileController,
    PegawaiController,
    KendaraanController,
    DashboardController,
    PeminjamanController,
    MaintenanceKendaraanController,
    PajakKendaraanController
};

/*
|--------------------------------------------------------------------------
| PUBLIC
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| PROTECTED (LOGIN WAJIB)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    // DASHBOARD
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // EXPORT EXCEL
    Route::get('/peminjaman/export', [PeminjamanController::class, 'export'])
    ->name('peminjaman.export');

    // CRUD
    Route::resource('pegawai', PegawaiController::class);
    Route::resource('kendaraan', KendaraanController::class);
    Route::resource('peminjaman', PeminjamanController::class);

    // PROFILE
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // PEMINJAMAN EXTRA
    Route::post('/peminjaman/{peminjaman}/selesai', [PeminjamanController::class, 'selesai'])
        ->name('peminjaman.selesai');

    Route::post('/peminjaman/{peminjaman}/batal', [PeminjamanController::class, 'batal'])
        ->name('peminjaman.batal');

    Route::post('/peminjaman/{peminjaman}/cetak', [PeminjamanController::class, 'cetak'])
        ->name('peminjaman.cetak');

    // SEARCH
    Route::get('/search/pegawai', [PegawaiController::class, 'search'])
        ->name('pegawai.search');

    Route::get('/search/kendaraan', [KendaraanController::class, 'search'])
        ->name('kendaraan.search');
    
    // MAINTENANCE
    Route::get('/maintenance', [MaintenanceKendaraanController::class, 'index'])
    ->name('maintenance.index');

    Route::post('/maintenance', [MaintenanceKendaraanController::class, 'store'])
        ->name('maintenance.store');
            
    Route::resource('maintenance', MaintenanceKendaraanController::class);

    Route::delete('/maintenance/{id}', [MaintenanceKendaraanController::class, 'destroy'])
        ->name('maintenance.destroy');
    
    // PAJAK
    Route::get('/pajak', [PajakKendaraanController::class, 'index'])
        ->name('pajak.index');
        
    Route::resource('pajak', PajakKendaraanController::class);

});

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';
