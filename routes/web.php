<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\KendaraanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PeminjamanController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');


/*
|--------------------------------------------------------------------------
| ROUTE HANYA UNTUK USER LOGIN
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    Route::resource('pegawai', PegawaiController::class);
    Route::resource('kendaraan', KendaraanController::class);
    Route::resource('peminjaman', PeminjamanController::class);

    /*
    |--------------------------------------------------------------------------
    | PROFILE USER
    |--------------------------------------------------------------------------
    */
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    /*
    |--------------------------------------------------------------------------
    | EXPORT SURAT (WAJIB DITARUH SEBELUM RESOURCE)
    |--------------------------------------------------------------------------
    */
  // CETAK PDF PEMUTIHAN
    Route::post('/kendaraan/{kendaraan}/cetak-pemutihan',
        [KendaraanController::class, 'cetakPemutihan']
    )->name('kendaraan.cetak.pemutihan');

    // CETAK PDF SPBKB
    Route::post('/kendaraan/{kendaraan}/cetak-spbkb',
        [KendaraanController::class, 'cetakSpbkb']
    )->name('kendaraan.cetak.spbkb');

    /*
    |--------------------------------------------------------------------------
    | PENCARIAN DATA KENDARAAN
    |--------------------------------------------------------------------------
    */
    Route::get('/kendaraan-search',
        [KendaraanController::class, 'search']
    )->name('kendaraan.search');


    /*
    |--------------------------------------------------------------------------
    | CRUD KENDARAAN (HARUS DIBAWAH EXPORT)
    |--------------------------------------------------------------------------
    */
    Route::resource('kendaraan', KendaraanController::class);


    /*
    |--------------------------------------------------------------------------
    | CRUD PEGAWAI
    |--------------------------------------------------------------------------
    */
    Route::resource('pegawai', PegawaiController::class);


    Route::resource('peminjaman', PeminjamanController::class);
    Route::resource('peminjaman', PeminjamanController::class);

    Route::post('/peminjaman/{peminjaman}/cetak',
        [PeminjamanController::class, 'cetak']
    )->name('peminjaman.cetak');

    // extra actions
    Route::post('/peminjaman/{peminjaman}/selesai', [PeminjamanController::class, 'selesai'])->name('peminjaman.selesai');
    Route::post('/peminjaman/{peminjaman}/batal', [PeminjamanController::class, 'batal'])->name('peminjaman.batal');
    Route::post('/peminjaman/{peminjaman}/cetak', [PeminjamanController::class, 'cetak'])->name('peminjaman.cetak');
    
    Route::get('/search/pegawai', [PegawaiController::class, 'search'])
    ->name('pegawai.search');

    Route::get('/search/kendaraan', [KendaraanController::class, 'search'])
        ->name('kendaraan.search');

});

require __DIR__.'/auth.php';
