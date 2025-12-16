@extends('layouts.app')

@section('content')
<div class="container-fluid px-4 animate-page">

    <h3 class="mb-4 fw-bold title-header">Manajemen Pegawai</h3>

    {{-- Tombol Tambah --}}
    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('pegawai.create') }}" class="btn btn-success shadow-btn">
            <i class="bi bi-person-plus"></i> Tambah
        </a>
    </div>

    {{-- Notifikasi --}}
    @if (session('success'))
        <div class="alert alert-success fade-up">{{ session('success') }}</div>
    @endif

    {{-- Tabel Pegawai --}}
    <div class="card p-4 border-0 shadow-section fade-up delay-1">
        <div class="table-responsive">
            <table class="table table-hover table-striped align-middle text-center">
                <thead class="table-header">
                    <tr>
                        <th>#</th>
                        <th>NIP</th>
                        <th>Nama</th>
                        <th>Jabatan</th>
                        <th>Email</th>
                        <th>Telepon</th>
                        <th>Alamat</th>
                        <th width="130">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                @forelse ($pegawai as $index => $item)
                <tr class="row-hover">
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->nip }}</td>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->jabatan }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->telepon }}</td>
                    <td class="text-start">{{ $item->alamat }}</td>

                    <td>
                        <div class="action-buttons d-flex flex-column gap-2">

                            {{-- Edit --}}
                            <a href="{{ route('pegawai.edit', $item->id) }}"
                                class="btn-card btn-yellow">
                                <i class="bi bi-pencil-square"></i>
                            </a>

                            {{-- Hapus --}}
                            <form action="{{ route('pegawai.destroy', $item->id) }}"
                                method="POST"
                                onsubmit="return confirm('Yakin ingin menghapus?')">
                                @csrf @method('DELETE')
                                <button class="btn-card btn-red">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>

                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="10" class="text-muted">Tidak ada data...</td>
                </tr>
                @endforelse
                </tbody>

            </table>
        </div>
    </div>

</div>

<style>
/* Animasi Halaman */
.animate-page { animation: fadeIn .6s ease-in-out; }
.fade-up { animation: fadeUp .7s ease forwards; opacity: 0; }
.delay-1 { animation-delay: .15s; }

@keyframes fadeIn { from { opacity:0; } to { opacity:1; } }
@keyframes fadeUp { from { opacity:0; transform:translateY(20px);} to {opacity:1; transform:translateY(0);} }

/* Card Style */
.shadow-section {
    border-radius: 14px;
    background: #fff;
    box-shadow: 0 4px 14px rgba(0,0,0,0.08);
}

/* Table Style */
.table-header {
    background: #a6785d !important;
    color: #fff;
    font-weight: 600;
}
.row-hover:hover {
    background: #f8f3ee !important;
    transition: .25s;
}

/* Tombol Aksi */
.action-buttons .btn-card {
    width: 100%;
    height: 35px;
    border-radius: 10px;
    border: none;
    font-size: 14px;
    background: #fff;
    box-shadow: 0 3px 10px rgba(0,0,0,.15);
    color: #555;
    transition: .25s;
}
.btn-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 18px rgba(0,0,0,.25);
}
.btn-yellow { color: #c48c00; }
.btn-red { color: #d9534f; }

/* Header */
.title-header {
    color: #44322f;
    font-weight: bold;
}
</style>

<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

@endsection
