@extends('layouts.app')

@section('content')
<div class="container-fluid px-4 animate-page">

    <h3 class="mb-4 fw-bold title-header">Dashboard Kendaraan Dinas</h3>

    {{-- CARD STATISTIK --}}
    <div class="row g-4 fade-up justify-content-center">

        {{-- Pegawai --}}
        <div class="col-md-3 col-6">
            <div class="stat-card">
                <div class="icon-circle bg-blue">
                    <i class="bi bi-people-fill"></i>
                </div>
                <h6 class="label">Total Pegawai</h6>
                <h2 class="value">{{ $totalPegawai }}</h2>
            </div>
        </div>

        {{-- Kendaraan --}}
        <div class="col-md-3 col-6">
            <div class="stat-card">
                <div class="icon-circle bg-green">
                    <i class="bi bi-car-front-fill"></i>
                </div>
                <h6 class="label">Total Kendaraan</h6>
                <h2 class="value">{{ $totalKendaraan }}</h2>
            </div>
        </div>

        {{-- Peminjaman --}}
        <div class="col-md-3 col-6">
            <div class="stat-card">
                <div class="icon-circle bg-yellow">
                    <i class="bi bi-arrow-left-right"></i>
                </div>
                <h6 class="label">Total Peminjaman</h6>
                <h2 class="value">{{ $totalTransaksi }}</h2>
            </div>
        </div>
    </div>


    {{-- Footer info --}}
    <div class="text-muted mt-4 fade-up delay-1">
        <small><i class="bi bi-info-circle me-1"></i> Data diperbarui secara otomatis dari sistem</small>
    </div>

</div>


{{-- CSS HALUS & MODERN --}}
<style>
.title-header {
    color: #44322f;
}

/* Card Statistik */
.stat-card {
    background: #ffffff;
    border-radius: 14px;
    padding: 22px;
    box-shadow: 0 6px 18px rgba(0,0,0,.08);
    text-align: center;
    transition: .25s;
}
.stat-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 10px 26px rgba(0,0,0,.12);
}

.icon-circle {
    width: 54px;
    height: 54px;
    display:flex;
    justify-content:center;
    align-items:center;
    border-radius:50%;
    margin: 0 auto 10px;
    font-size: 24px;
    color: #fff;
}
.bg-blue { background: #0277bd; }
.bg-green { background: #2e7d32; }
.bg-yellow { background: #f9a825; }
.bg-red { background: #c62828; }

.label {
    font-size: 13px;
    letter-spacing: .3px;
    color: #6d4c41;
}
.value {
    font-weight: 800;
    color: #3e2723;
}

/* Animasi Halus */
.animate-page { animation: fadeIn .7s ease-in-out; }
.fade-up { animation: fadeUp 1s ease both; }
.delay-1 { animation-delay: .2s; }

@keyframes fadeIn { from {opacity:0;} to {opacity:1;} }
@keyframes fadeUp { from {opacity:0; transform:translateY(25px);} to {opacity:1; transform:translateY(0);} }

</style>

<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

@endsection
