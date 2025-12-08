@extends('layouts.app')

@section('content')
<h3 class="mb-4">Tambah Transaksi</h3>

<form action="{{ route('transaksi.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label>Pegawai</label>
        <select name="pegawai_id" class="form-control">
            @foreach ($pegawais as $pegawai)
            <option value="{{ $pegawai->id }}">{{ $pegawai->nama }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label>Kendaraan</label>
        <select name="kendaraan_id" class="form-control">
            @foreach ($kendaraans as $kendaraan)
            <option value="{{ $kendaraan->id }}">{{ $kendaraan->nomor_polisi }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label>Jenis Transaksi</label>
        <select name="jenis" class="form-control">
            <option value="pinjam">Pinjam</option>
            <option value="servis">Servis</option>
        </select>
    </div>

    <div class="mb-3">
        <label>Tujuan</label>
        <input type="text" name="tujuan" class="form-control" placeholder="Tujuan penggunaan kendaraan">
    </div>

    <div class="mb-3">
        <label>Tanggal Mulai</label>
        <input type="date" name="tanggal_mulai" class="form-control">
    </div>

    <div class="mb-3">
        <label>Tanggal Selesai</label>
        <input type="date" name="tanggal_selesai" class="form-control">
    </div>

    <div class="mb-3">
        <label>Status</label>
        <select name="status" class="form-control">
            <option value="ongoing">Ongoing</option>
            <option value="selesai">Selesai</option>
            <option value="dibatalkan">Dibatalkan</option>
        </select>
    </div>

    <div class="mb-3">
        <label>Keterangan</label>
        <textarea name="keterangan" class="form-control" rows="3"></textarea>
    </div>

    <button class="btn btn-success">Simpan</button>
    <a href="{{ route('transaksi.index') }}" class="btn btn-secondary">Kembali</a>
</form>
@endsection
