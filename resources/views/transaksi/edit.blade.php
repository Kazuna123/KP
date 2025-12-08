@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h3 class="mb-4">Edit Transaksi</h3>

    <form action="{{ route('transaksi.update', $transaksi->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="pegawai_id" class="form-label">Pegawai</label>
            <select name="pegawai_id" id="pegawai_id" class="form-control" required>
                <option value="">-- Pilih Pegawai --</option>
                @foreach($pegawais as $pegawai)
                    <option value="{{ $pegawai->id }}" {{ $pegawai->id == $transaksi->pegawai_id ? 'selected' : '' }}>
                        {{ $pegawai->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="kendaraan_id" class="form-label">Kendaraan</label>
            <select name="kendaraan_id" id="kendaraan_id" class="form-control" required>
                <option value="">-- Pilih Kendaraan --</option>
                @foreach($kendaraans as $kendaraan)
                    <option value="{{ $kendaraan->id }}" {{ $kendaraan->id == $transaksi->kendaraan_id ? 'selected' : '' }}>
                        {{ $kendaraan->nomor_polisi }} - {{ $kendaraan->merk }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="jenis" class="form-label">Jenis Transaksi</label>
            <select name="jenis" id="jenis" class="form-control" required>
                <option value="pinjam" {{ $transaksi->jenis == 'pinjam' ? 'selected' : '' }}>Pinjam</option>
                <option value="servis" {{ $transaksi->jenis == 'servis' ? 'selected' : '' }}>Servis</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="tujuan" class="form-label">Tujuan</label>
            <input type="text" name="tujuan" id="tujuan" value="{{ $transaksi->tujuan }}" class="form-control" placeholder="Masukkan tujuan (opsional)">
        </div>

        <div class="mb-3">
            <label for="tanggal_mulai" class="form-label">Tanggal Mulai</label>
            <input type="date" name="tanggal_mulai" id="tanggal_mulai" value="{{ $transaksi->tanggal_mulai }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="tanggal_selesai" class="form-label">Tanggal Selesai</label>
            <input type="date" name="tanggal_selesai" id="tanggal_selesai" value="{{ $transaksi->tanggal_selesai }}" class="form-control">
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" id="status" class="form-control" required>
                <option value="ongoing" {{ $transaksi->status == 'ongoing' ? 'selected' : '' }}>Ongoing</option>
                <option value="selesai" {{ $transaksi->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                <option value="dibatalkan" {{ $transaksi->status == 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="keterangan" class="form-label">Keterangan</label>
            <textarea name="keterangan" id="keterangan" class="form-control" rows="3" placeholder="Tambahkan keterangan...">{{ $transaksi->keterangan }}</textarea>
        </div>

        <div class="d-flex justify-content-between">
            <a href="{{ route('transaksi.index') }}" class="btn btn-secondary">Kembali</a>
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </div>
    </form>
</div>
@endsection
