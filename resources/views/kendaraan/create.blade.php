@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <h2 class="mb-4">Tambah Kendaraan</h2>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $err)
                <li>{{ $err }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('kendaraan.store') }}" method="POST">
        @csrf

        {{-- =============================== --}}
        {{-- DATA PEGAWAI --}}
        {{-- =============================== --}}
        <h5 class="mt-3 mb-2">Data Pegawai</h5>
        <div class="row">
            <div class="col-md-4 mb-3">
                <label class="form-label fw-semibold">Pilih Pegawai</label>
                <select name="pegawai_id" class="form-select" required>
                    <option value="">-- Pilih Pegawai --</option>
                    @foreach(\App\Models\Pegawai::orderBy('nama')->get() as $p)
                        <option value="{{ $p->id }}">
                            {{ $p->nama }} - {{ $p->nip }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-4 mb-3">
                <label class="form-label fw-semibold">Jabatan</label>
                <input type="text" class="form-control" disabled placeholder="Otomatis dari data pegawai">
            </div>
        </div>

        {{-- =============================== --}}
        {{-- DATA KENDARAAN --}}
        {{-- =============================== --}}
        <h5 class="mt-4 mb-2">Data Kendaraan</h5>
        <div class="row">

            <div class="col-md-4 mb-3">
                <label class="form-label fw-semibold">Jenis Kendaraan</label>
                <input type="text" name="jenis" class="form-control" placeholder="Contoh: Roda 2 / Roda 4" required>
            </div>

            <div class="col-md-4 mb-3">
                <label class="form-label fw-semibold">Merk</label>
                <input type="text" name="merk" class="form-control" required>
            </div>

            <div class="col-md-4 mb-3">
                <label class="form-label fw-semibold">Type</label>
                <input type="text" name="tipe" class="form-control" required>
            </div>

            <div class="col-md-4 mb-3">
                <label class="form-label fw-semibold">Nomor Polisi</label>
                <input type="text" name="nomor_polisi" class="form-control" required>
            </div>

            <div class="col-md-4 mb-3">
                <label class="form-label fw-semibold">Tahun (Dalam Angka)</label>
                <input type="number" name="tahun" class="form-control" required>
            </div>

            <div class="col-md-4 mb-3">
                <label class="form-label fw-semibold">Nomor Rangka</label>
                <input type="text" name="nomor_rangka" class="form-control">
            </div>

            <div class="col-md-4 mb-3">
                <label class="form-label fw-semibold">Nomor Mesin</label>
                <input type="text" name="nomor_mesin" class="form-control">
            </div>

            <div class="col-md-4 mb-3">
                <label class="form-label fw-semibold">Fungsi</label>
                <input type="text" name="fungsi" class="form-control" placeholder="Contoh: Operasional kantor">
            </div>

            <div class="col-md-12 mb-3">
                <label class="form-label fw-semibold">Keterangan</label>
                <textarea name="ket" class="form-control" rows="2"></textarea>
            </div>

            <div class="col-md-4 mb-3">
                <label class="form-label fw-semibold">Status</label>
                <select name="status" class="form-select" required>
                    <option value="tersedia">Tersedia</option>
                    <option value="dipinjam">Dipinjam</option>
                    <option value="maintenance">Maintenance</option>
                </select>
            </div>

        </div>

        <button type="submit" class="btn btn-success mt-3">Simpan</button>
        <a href="{{ route('kendaraan.index') }}" class="btn btn-secondary mt-3">Kembali</a>

    </form>
</div>
@endsection
