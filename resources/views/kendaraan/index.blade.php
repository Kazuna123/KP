@extends('layouts.app')

@section('content')
<div class="container-fluid px-4 animate-page">

    <h3 class="mb-4 fw-bold title-header">Data Kendaraan</h3>

    {{-- FORM INPUT --}}
    <div class="card mb-4 p-4 border-0 shadow-section fade-up">
        <form method="POST"
            action="{{ route('kendaraan.store') }}"
            enctype="multipart/form-data">
            @csrf

            <div class="row g-3">

                <div class="col-md-4">
                    <label class="fw-semibold">Jenis Kendaraan</label>
                    <input type="text" name="jenis" class="form-control"
                        placeholder="Roda 2 / Roda 4" required>
                </div>

                <div class="col-md-4">
                    <label class="fw-semibold">Nomor Polisi</label>
                    <input type="text" name="nomor_polisi" class="form-control" required>
                    @error('nomor_polisi')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror                    
                </div>

                <div class="col-md-4">
                    <label class="fw-semibold">Merk</label>
                    <input type="text" name="merk" class="form-control" required>
                </div>

                <div class="col-md-4">
                    <label class="fw-semibold">Tipe</label>
                    <input type="text" name="tipe" class="form-control" required>
                </div>

                <div class="col-md-4">
                    <label class="fw-semibold">Tahun</label>
                    <input type="number" name="tahun" class="form-control" required>
                </div>

                <div class="col-md-4">
                    <label class="fw-semibold">Nomor Rangka</label>
                    <input type="text" name="nomor_rangka" class="form-control">
                </div>

                <div class="col-md-4">
                    <label class="fw-semibold">Nomor Mesin</label>
                    <input type="text" name="nomor_mesin" class="form-control">
                </div>

                {{-- FOTO KENDARAAN --}}
                <div class="col-md-4">
                    <label class="fw-semibold">
                        Foto Kendaraan
                        <small class="text-muted">(jpg / png)</small>
                    </label>
                    <input type="file"
                        name="foto_kendaraan"
                        class="form-control"
                        accept="image/*">
                </div>

                {{-- FOTO STNK --}}
                <div class="col-md-4">
                    <label class="fw-semibold">
                        Foto STNK
                        <small class="text-muted">(jpg / png)</small>
                    </label>
                    <input type="file"
                        name="foto_stnk"
                        class="form-control"
                        accept="image/*">
                </div>

                <div class="col-md-4">
                    <label class="fw-semibold">Status</label>
                    <select name="status" class="form-select">
                        <option value="tersedia">Tersedia</option>
                        <option value="dipinjam">Dipinjam</option>
                        <option value="maintenance">Maintenance</option>
                    </select>
                </div>

                {{-- KONDISI KENDARAAN --}}
                <div class="col-md-4">
                    <label class="fw-semibold">Kondisi Kendaraan</label>
                    <select name="kondisi" class="form-select" required>
                        <option value="baik">Baik</option>
                        <option value="rusak_ringan">Rusak Ringan</option>
                        <option value="rusak_berat">Rusak Berat</option>
                    </select>
                </div>
                <div class="col-md-4 d-flex align-items-end">
                    <button class="btn btn-success shadow-btn w-100">
                        <i class="bi bi-plus-lg me-1"></i> Tambah
                    </button>
                </div>
            </div>
        </form>
    </div>

    {{-- TABEL --}}
    <div class="card p-4 border-0 shadow-section fade-up delay-1">
        <div class="table-responsive">
            <table class="table table-hover table-striped align-middle text-center">
                <thead class="table-header">
                    <tr>
                        <th>No</th>
                        <th>Jenis</th>
                        <th>Nopol</th>
                        <th>Merk / Tipe</th>
                        <th>Tahun</th>
                        <th>Kondisi</th>
                        <th>Status</th>
                        <th>Foto</th>
                        <th>STNK</th>
                        <th width="120">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($kendaraans as $k)
                    <tr class="row-hover">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $k->jenis ?? '-' }}</td>
                        <td>{{ $k->nomor_polisi }}</td>
                        <td>{{ $k->merk }} / {{ $k->tipe }}</td>
                        <td>{{ $k->tahun }}</td>
                    
                        {{-- KONDISI --}}
                        <td>
                            <span class="badge 
                                {{ $k->kondisi == 'baik' ? 'bg-success' : 
                                   ($k->kondisi == 'rusak ringan' ? 'bg-warning' : 'bg-danger') }}">
                                {{ ucfirst($k->kondisi) }}
                            </span>
                        </td>
                    
                        {{-- STATUS --}}
                        <td>
                            <span class="badge status-badge {{ $k->status }}">
                                {{ ucfirst($k->status) }}
                            </span>
                        </td>
                    
                        {{-- FOTO KENDARAAN --}}
                        <td>
                            @if($k->foto_kendaraan)
                                <a href="{{ asset('storage/'.$k->foto_kendaraan) }}" target="_blank">
                                    <img src="{{ asset('storage/'.$k->foto_kendaraan) }}"
                                         class="img-thumbnail"
                                         style="width:50px; height:50px; object-fit:cover;">
                                </a>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                    
                        {{-- FOTO STNK --}}
                        <td>
                            @if($k->foto_stnk)
                                <a href="{{ asset('storage/'.$k->foto_stnk) }}" target="_blank"
                                   class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-file-earmark-text"></i>
                                </a>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                    
                        {{-- AKSI --}}
                        <td>
                            <div class="action-buttons d-flex justify-content-center gap-2">
                                <a href="{{ route('kendaraan.edit', $k->id) }}"
                                    class="btn-card btn-yellow"
                                    data-bs-toggle="tooltip"
                                    title="Edit Kendaraan">
                                    <i class="bi bi-pencil"></i>
                                </a>
                    
                                <button type="button"
                                        class="btn-card btn-red"
                                        onclick="hapusKendaraan('{{ route('kendaraan.destroy', $k->id) }}')"
                                        data-bs-toggle="tooltip"
                                        title="Hapus Data Kendaraan">
                                    <i class="bi bi-trash"></i>
                                </button>
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

            {{ $kendaraans->withQueryString()->links() }}
        </div>
    </div>
    
    <!-- MODAL KONFIRMASI HAPUS -->
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
                        Apakah Anda yakin ingin menghapus data kendaraan ini?
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
</div>

<style>
/* Animasi */
.animate-page { animation: fadeIn .6s ease-in-out; }
.fade-up { animation: fadeUp .8s ease both; }
.delay-1 { animation-delay: .15s; }
@keyframes fadeIn { from {opacity:0;} to {opacity:1;} }
@keyframes fadeUp { from{opacity:0;transform:translateY(20px);} to{opacity:1;transform:translateY(0);} }

/* Header Style */
.title-header { color: #44322f; }

/* Shadow */
.shadow-section {
    border-radius: 14px;
    background: #fff;
    box-shadow: 0 4px 14px rgba(0,0,0,0.08);
}

/* Table */
.table-header { background: #a6785d !important; color: #fff; font-weight: 600; }
.row-hover:hover { background: #f7f2ee !important; transition: .2s; }

/* Status */
.status-badge {
    padding: 6px 12px;
    font-size: 12px;
    border-radius: 6px;
    text-transform: capitalize;
}
.status-badge.tersedia { background:#28a745; color:#fff; }
.status-badge.dipinjam { background:#f5e05e; color:#3a2e00; }
.status-badge.maintenance { background:#6c757d; color:#fff; }

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

.shadow-btn {
    padding: 8px 12px;
    border-radius: 10px;
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
    background: #3e2723;
    color: #fff;
}

.btn-outline-brown {
    border: 1.5px solid #4e342e;
    color: #4e342e;
    background: transparent;
    transition: .2s;
}

.btn-outline-brown:hover {
    background: #4e342e;
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

    function hapusKendaraan(url) {
        const form = document.getElementById('formHapus');
        form.action = url;

        const modal = new bootstrap.Modal(document.getElementById('hapusModal'));
        modal.show();
    }
</script>
@endsection
