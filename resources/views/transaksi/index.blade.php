@extends('layouts.app')

@section('content')
<h3 class="mb-4">Daftar Transaksi</h3>

<a href="{{ route('transaksi.create') }}" class="btn btn-primary mb-3">+ Tambah Transaksi</a>

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Pegawai</th>
            <th>Kendaraan</th>
            <th>Jenis</th>
            <th>Tujuan</th>
            <th>Tanggal Mulai</th>
            <th>Tanggal Selesai</th>
            <th>Status</th>
            <th>Keterangan</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($transaksis as $item)
        <tr>
            <td>{{ $item->id }}</td>
            <td>{{ $item->pegawai->nama ?? '-' }}</td>
            <td>{{ $item->kendaraan->nomor_polisi ?? '-' }}</td>
            <td>{{ ucfirst($item->jenis) }}</td>
            <td>{{ $item->tujuan ?? '-' }}</td>
            <td>{{ $item->tanggal_mulai }}</td>
            <td>{{ $item->tanggal_selesai ?? '-' }}</td>
            <td>{{ ucfirst($item->status) }}</td>
            <td>{{ $item->keterangan ?? '-' }}</td>
            <td>
                <a href="{{ route('transaksi.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('transaksi.destroy', $item->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus data ini?')">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
