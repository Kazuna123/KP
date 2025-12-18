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
                        <div class="action-buttons d-flex justify-content-center gap-2">
                            {{-- Edit --}}
                            <a href="{{ route('pegawai.edit', $item->id) }}"
                                class="btn-card btn-yellow"
                                data-bs-toggle="tooltip"
                                data-bs-placement="top"
                                title="Edit Pegawai">
                                 <i class="bi bi-pencil-square"></i>
                            </a>                        

                            {{-- Hapus --}}
                            <form action="{{ route('pegawai.destroy', $item->id) }}"
                                method="POST">
                                @csrf @method('DELETE')
                                <button type="button"
                                        class="btn-card btn-red"
                                        data-bs-toggle="tooltip"
                                        title="Hapus Pegawai"
                                        onclick="hapusPegawai('{{ route('pegawai.destroy', $item->id) }}')">
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
    <div class="modal fade" id="hapusModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg rounded-4 modal-brown">

                <div class="modal-header modal-header-brown rounded-top-4">
                    <h5 class="modal-title">
                        <i class="bi bi-exclamation-triangle me-2"></i> Konfirmasi Hapus
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body text-center">
                    <p class="mb-2 fw-semibold text-brown">
                        Apakah Anda yakin ingin menghapus data pegawai ini?
                    </p>
                    <small class="text-muted">
                        Data yang dihapus tidak dapat dikembalikan.
                    </small>
                </div>

                <div class="modal-footer justify-content-center gap-3">
                    <button type="button" class="btn btn-outline-brown px-4" data-bs-dismiss="modal">
                        Batal
                    </button>

                    <form id="formHapus" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-brown px-4">
                            <i class="bi bi-trash me-1"></i> Hapus
                        </button>
                    </form>
                </div>

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
.btn-card {
    width: 100%;
    border-radius: 10px;
    height: 34px;
    border: none;
    font-weight: bold;
    background: #fff;
    box-shadow: 0 3px 10px rgba(0,0,0,.15);
    transition: .2s;
}
.btn-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 6px 12px rgba(0,0,0,.2);
}
.btn-yellow { color:#d39e00; }
.btn-red { color:#d9534f; }

/* Header */
.title-header {
    color: #44322f;
    font-weight: bold;
}

/* modal */
/* ===== MODAL DARK BROWN THEME ===== */

.modal-brown {
    background: #fdfaf7;
}

.modal-header-brown {
    background: linear-gradient(135deg, #4e342e, #6d4c41);
    color: #fff;
    border-bottom: none;
}

.text-brown {
    color: #000000;
}

/* BUTTON */
.btn-brown {
    background: #4e342e;
    color: #fff;
    border: none;
    transition: .2s;
}

.btn-brown:hover {
    background: #262626;
    color: #fff;
}

.btn-outline-brown {
    border: 1.5px solid #4e342e;
    color: #4e342e;
    background: transparent;
    transition: .2s;
}

.btn-outline-brown:hover {
    background: #262626;
    color: #fff;
}

.modal {
    z-index: 1055 !important;
}
.modal-backdrop {
    z-index: 1050 !important;
}
</style>

<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const tooltipTriggerList = [].slice.call(
            document.querySelectorAll('[data-bs-toggle="tooltip"]')
        );
        tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });

    function hapusPegawai(url) {
        const form = document.getElementById('formHapus');
        form.action = url;

        const modal = new bootstrap.Modal(document.getElementById('hapusModal'));
        modal.show();
    }
</script>
    
@endsection
