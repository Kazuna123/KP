@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Edit Kendaraan</h2>

    @if ($errors->any())
      <div class="alert alert-danger">
          <ul class="mb-0">
              @foreach ($errors->all() as $err)
                  <li>{{ $err }}</li>
              @endforeach
          </ul>
      </div>
    @endif

    <form action="{{ route('kendaraan.update', $kendaraan->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nomor_polisi" class="form-label">Nomor Polisi</label>
            <input type="text" name="nomor_polisi" id="nomor_polisi" class="form-control" value="{{ old('nomor_polisi', $kendaraan->nomor_polisi) }}" required>
        </div>

        <div class="mb-3">
            <label for="merk" class="form-label">Merk</label>
            <input type="text" name="merk" id="merk" class="form-control" value="{{ old('merk', $kendaraan->merk) }}" required>
        </div>

        <div class="mb-3">
            <label for="tipe" class="form-label">Tipe</label>
            <input type="text" name="tipe" id="tipe" class="form-control" value="{{ old('tipe', $kendaraan->tipe) }}" required>
        </div>

        <div class="mb-3">
            <label for="tahun" class="form-label">Tahun</label>
            <input type="number" name="tahun" id="tahun" class="form-control" value="{{ old('tahun', $kendaraan->tahun) }}" required>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" id="status" class="form-select" required>
                <option value="tersedia" {{ old('status', $kendaraan->status)=='tersedia' ? 'selected' : '' }}>Tersedia</option>
                <option value="dipinjam" {{ old('status', $kendaraan->status)=='dipinjam' ? 'selected' : '' }}>Dipinjam</option>
                <option value="maintenance" {{ old('status', $kendaraan->status)=='maintenance' ? 'selected' : '' }}>Maintenance</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('kendaraan.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
