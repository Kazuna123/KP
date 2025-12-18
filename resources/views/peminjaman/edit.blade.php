@extends('layouts.app')

@section('content')
<div class="container">

    <h3>Edit Data Peminjaman</h3>
    <hr>

    <form action="{{ route('peminjaman.update', $peminjaman->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Pegawai -->
        <div class="mb-3">
            <label>Pegawai</label>
            <select name="pegawai_id" class="form-control" required>
                @foreach ($pegawai as $pg)
                    <option value="{{ $pg->id }}"
                        {{ $peminjaman->pegawai_id == $pg->id ? 'selected' : '' }}>
                        {{ $pg->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Kendaraan -->
        <div class="mb-3">
            <label>Kendaraan</label>
            <select name="kendaraan_id" class="form-control" required>
                @foreach ($kendaraan as $kd)
                    <option value="{{ $kd->id }}"
                        {{ $peminjaman->kendaraan_id == $kd->id ? 'selected' : '' }}>
                        {{ $kd->nomor_polisi }} - {{ $kd->merk }} ({{ $kd->status }})
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Tanggal Pinjam -->
        <div class="mb-3">
            <label>Tanggal Pinjam</label>
            <input type="date" name="tanggal_pinjam" value="{{ $peminjaman->tanggal_pinjam }}" class="form-control" required>
        </div>

        <!-- Tanggal Kembali -->
        <div class="mb-3">
            <label>Tanggal Kembali</label>
            <input type="date" name="tanggal_kembali" value="{{ $peminjaman->tanggal_kembali }}" class="form-control">
        </div>

        <!-- Keterangan -->
        <div class="mb-3">
            <label>Keterangan</label>
            <textarea class="form-control" name="keterangan">{{ $peminjaman->keterangan }}</textarea>
        </div>

        <!-- Status -->
        {{-- <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-control">
                <option value="ongoing" {{ $peminjaman->status == 'ongoing' ? 'selected' : '' }}>Dipinjam</option>
                <option value="selesai" {{ $peminjaman->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                <option value="dibatalkan" {{ $peminjaman->status == 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
            </select>
        </div> --}}

        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>

    </form>

</div>
@endsection
