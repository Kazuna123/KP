@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="mb-4">📅 Daftar Pencatatan Tanggal</h3>

    <a href="{{ route('pencatatan.create') }}" class="btn btn-primary mb-3">+ Tambah Pencatatan</a>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Transaksi ID</th>
                <th>Tanggal</th>
                <th>Catatan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pencatatans as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->transaksi_id }}</td>
                    <td>{{ $item->tanggal }}</td>
                    <td>{{ $item->catatan ?? '-' }}</td>
                    <td>
                        <a href="{{ route('pencatatan.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>

                        <form action="{{ route('pencatatan.destroy', $item->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
