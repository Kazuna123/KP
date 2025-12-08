@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="mb-4">Edit Pencatatan</h3>

    <form action="{{ route('pencatatan.update', $pencatatan->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="transaksi_id" class="form-label">Transaksi ID</label>
            <input type="number" name="transaksi_id" id="transaksi_id" class="form-control" value="{{ $pencatatan->transaksi_id }}" required>
        </div>

        <div class="mb-3">
            <label for="tanggal" class="form-label">Tanggal</label>
            <input type="date" name="tanggal" id="tanggal" class="form-control" value="{{ $pencatatan->tanggal }}" required>
        </div>

        <div class="mb-3">
            <label for="catatan" class="form-label">Catatan</label>
            <textarea name="catatan" id="catatan" class="form-control">{{ $pencatatan->catatan }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('pencatatan.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
