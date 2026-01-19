@extends('layouts.app')

@section('content')
<div class="container-fluid px-4 animate-page">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold mb-0">
            <i class="bi bi-speedometer me-2"></i> Dashboard Kendaraan Dinas
        </h3>
    </div>

    {{-- CARD STATISTIK --}}
    <div class="row g-4 fade-up">

        <div class="col-md-3 col-6">
            <div class="stat-card">
                <div class="icon-circle bg-blue">
                    <i class="bi bi-people-fill"></i>
                </div>
                <h6 class="label">Total Pegawai</h6>
                <h2 class="value">{{ $totalPegawai }}</h2>
            </div>
        </div>

        <div class="col-md-3 col-6">
            <div class="stat-card">
                <div class="icon-circle bg-green">
                    <i class="bi bi-car-front-fill"></i>
                </div>
                <h6 class="label">Total Kendaraan</h6>
                <h2 class="value">{{ $totalKendaraan }}</h2>
            </div>
        </div>

        <div class="col-md-3 col-6">
            <div class="stat-card">
                <div class="icon-circle bg-yellow">
                    <i class="bi bi-arrow-left-right"></i>
                </div>
                <h6 class="label">Total Peminjaman</h6>
                <h2 class="value">{{ $totalPeminjaman }}</h2>
            </div>
        </div>

        <div class="col-md-3 col-6">
            <div class="stat-card">
                <div class="icon-circle bg-red">
                    <i class="bi bi-exclamation-triangle-fill"></i>
                </div>
                <h6 class="label">Pajak Kadaluarsa</h6>
                <h2 class="value text-danger">{{ $pajakKadaluarsa }}</h2>
            </div>
        </div>

    </div>

    {{-- RINGKASAN OPERASIONAL --}}
    <div class="row g-4 mt-4 fade-up delay-1">

        <div class="col-md-4">
            <div class="info-card">
                <i class="bi bi-check-circle-fill text-success"></i>
                Kendaraan Tersedia:
                <strong>{{ $kendaraanAktif }}</strong>
            </div>
        </div>

        <div class="col-md-4">
            <div class="info-card">
                <i class="bi bi-arrow-left-right text-warning"></i>
                Kendaraan Dipinjam:
                <strong>{{ $kendaraanDipinjam }}</strong>
            </div>
        </div>

        <div class="col-md-4">
            <div class="info-card">
                <i class="bi bi-tools text-danger"></i>
                Maintenance:
                <strong>{{ $kendaraanMaintenance }}</strong>
            </div>
        </div>

    </div>

    {{-- ALERT PAJAK --}}
    @if($pajakH30 > 0)
        <div class="alert alert-warning mt-4 shadow-sm fade-up delay-2">
            <i class="bi bi-clock-history me-1"></i>
            Ada <strong>{{ $pajakH30 }}</strong> kendaraan yang
            pajaknya akan jatuh tempo dalam <strong>30 hari</strong>
        </div>
    @endif

    @if($pajakKadaluarsa > 0)
        <div class="alert alert-danger shadow-sm fade-up delay-2">
            <i class="bi bi-x-circle-fill me-1"></i>
            <strong>{{ $pajakKadaluarsa }}</strong> kendaraan memiliki
            pajak <strong>kadaluarsa</strong>
        </div>
    @endif

    {{-- FOOTER INFO --}}
    <div class="text-muted mt-4 fade-up delay-3">
        <small>
            <i class="bi bi-info-circle me-1"></i>
            Data diperbarui secara otomatis dari sistem
        </small>
    </div>

</div>

{{-- STYLE --}}
<style>
.title-header { color:#44322f; }

/* Statistik Card */
.stat-card {
    background:#fff;
    border-radius:14px;
    padding:22px;
    box-shadow:0 6px 18px rgba(0,0,0,.08);
    text-align:center;
    transition:.25s;
}
.stat-card:hover {
    transform:translateY(-6px);
    box-shadow:0 10px 26px rgba(0,0,0,.12);
}

.icon-circle {
    width:54px;
    height:54px;
    display:flex;
    justify-content:center;
    align-items:center;
    border-radius:50%;
    margin:0 auto 10px;
    font-size:24px;
    color:#fff;
}
.bg-blue { background:#0277bd; }
.bg-green { background:#2e7d32; }
.bg-yellow { background:#f9a825; }
.bg-red { background:#c62828; }

.label {
    font-size:13px;
    letter-spacing:.3px;
    color:#6d4c41;
}
.value {
    font-weight:800;
    color:#3e2723;
}

/* Info Card */
.info-card {
    background:#fff;
    padding:16px;
    border-radius:12px;
    box-shadow:0 4px 12px rgba(0,0,0,.07);
    font-size:14px;
    display:flex;
    align-items:center;
    gap:10px;
}

/* Animasi */
.animate-page { animation: fadeIn .7s ease; }
.fade-up { animation: fadeUp 1s ease both; }
.delay-1 { animation-delay:.2s; }
.delay-2 { animation-delay:.4s; }
.delay-3 { animation-delay:.6s; }

@keyframes fadeIn { from{opacity:0} to{opacity:1} }
@keyframes fadeUp { from{opacity:0; transform:translateY(25px)} to{opacity:1; transform:none} }
</style>

<link rel="stylesheet"

href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
@endsection
