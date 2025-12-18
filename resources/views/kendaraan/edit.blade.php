@extends('layouts.app')

@section('content')
<div class="container">

    <h3 class="mb-3">Edit Data Kendaraan</h3>

    <div class="card p-4 shadow-sm">
        <form action="{{ route('kendaraan.update', $kendaraan->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row g-3">

                <div class="col-md-4">
                    <label class="fw-semibold">Jenis Kendaraan</label>
                    <input type="text" name="jenis" class="form-control"
                           value="{{ $kendaraan->jenis }}" required>
                </div>

                <div class="col-md-4">
                    <label class="fw-semibold">Nomor Polisi</label>
                    <input type="text" name="nomor_polisi" class="form-control"
                           value="{{ $kendaraan->nomor_polisi }}" required>
                </div>

                <div class="col-md-4">
                    <label class="fw-semibold">Merk</label>
                    <input type="text" name="merk" class="form-control"
                           value="{{ $kendaraan->merk }}" required>
                </div>

                <div class="col-md-4">
                    <label class="fw-semibold">Tipe</label>
                    <input type="text" name="tipe" class="form-control"
                           value="{{ $kendaraan->tipe }}" required>
                </div>

                <div class="col-md-4">
                    <label class="fw-semibold">Tahun</label>
                    <input type="number" name="tahun" class="form-control"
                           value="{{ $kendaraan->tahun }}" required>
                </div>

                <div class="col-md-4">
                    <label class="fw-semibold">Nomor Rangka</label>
                    <input type="text" name="nomor_rangka" class="form-control"
                           value="{{ $kendaraan->nomor_rangka }}">
                </div>

                <div class="col-md-4">
                    <label class="fw-semibold">Nomor Mesin</label>
                    <input type="text" name="nomor_mesin" class="form-control"
                           value="{{ $kendaraan->nomor_mesin }}">
                </div>

                <div class="col-md-4">
                    <label class="fw-semibold">Status</label>
                    <select name="status" class="form-select">
                        <option value="tersedia" {{ $kendaraan->status == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                        <option value="dipinjam" {{ $kendaraan->status == 'dipinjam' ? 'selected' : '' }}>Dipinjam</option>
                        <option value="maintenance" {{ $kendaraan->status == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                    </select>
                </div>

            </div>

            <div class="mt-3">
                <button class="btn btn-primary">Simpan Perubahan</button>
                <a href="{{ route('kendaraan.index') }}" class="btn btn-secondary">Batal</a>
            </div>

        </form>
    </div>

</div>
@endsection
