@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h3 class="mb-4">Dashboard Kendaraan Dinas</h3>

    <div class="row">
        <div class="col-md-3">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h5>Total Pegawai</h5>
                    <h3>{{ $totalPegawai }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h5>Total Kendaraan</h5>
                    <h3>{{ $totalKendaraan }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h5>Total Transaksi</h5>
                    <h3>{{ $totalTransaksi }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h5>Total Pencatatan</h5>
                    <h3>{{ $totalPencatatan }}</h3>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
