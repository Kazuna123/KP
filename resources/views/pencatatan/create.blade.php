@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="mb-4">Tambah Pencatatan</h3>

    <form action="{{ route('pencatatan.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="transaksi_id" class="form-label">Transaksi ID</label>
            <input type="number" name="transaksi_id" id="transaksi_id" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="tanggal" class="form-label">Tanggal</label>
            <input type="date" name="tanggal" id="tanggal" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="catatan" class="form-label">Catatan</label>
            <textarea name="catatan" id="catatan" class="form-control"></textarea>
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('pencatatan.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
