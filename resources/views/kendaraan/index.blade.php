@extends('layouts.app')

@section('content')
<div class="container-fluid px-4 animate-page">

    <h3 class="mb-4 fw-bold title-header">Data Kendaraan</h3>

    {{-- FORM INPUT --}}
    <div class="card mb-4 p-4 border-0 shadow-section fade-up">
        <form method="POST" action="{{ route('kendaraan.store') }}">
            @csrf
            <div class="row g-3">

                <div class="col-md-4">
                    <label class="fw-semibold">Jenis Kendaraan</label>
                    <input type="text" name="jenis" class="form-control" placeholder="Roda 2 / Roda 4" required>
                </div>

                <div class="col-md-4">
                    <label class="fw-semibold">Nomor Polisi</label>
                    <input type="text" name="nomor_polisi" class="form-control" required>
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

                <div class="col-md-4">
                    <label class="fw-semibold">Status</label>
                    <select name="status" class="form-control">
                        <option value="tersedia">Tersedia</option>
                        <option value="dipinjam">Dipinjam</option>
                        <option value="maintenance">Maintenance</option>
                    </select>
                </div>

                <div class="col-md-4 d-flex align-items-end">
                    <button class="btn btn-success shadow-btn">
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
                        <th>#</th>
                        <th>Jenis</th>
                        <th>Nopol</th>
                        <th>Merk / Tipe</th>
                        <th>Tahun</th>
                        <th>No. Rangka</th>
                        <th>No. Mesin</th>
                        <th>Status</th>
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
                        <td>{{ $k->nomor_rangka ?? '-' }}</td>
                        <td>{{ $k->nomor_mesin ?? '-' }}</td>
                        <td>
                            <span class="badge status-badge {{ $k->status }}">
                                {{ ucfirst($k->status) }}
                            </span>
                        </td>
                        <td>
                            <div class="action-buttons d-flex flex-column gap-2">

                                <a href="{{ route('kendaraan.edit', $k->id) }}"
                                   class="btn-card btn-yellow">
                                   <i class="bi bi-pencil"></i>
                                </a>

                                <form action="{{ route('kendaraan.destroy', $k->id) }}"
                                      method="POST"
                                      onsubmit="return confirm('Yakin hapus?')">
                                    @csrf @method('DELETE')
                                    <button class="btn-card btn-red">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>

                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="10" class="text-muted">Tidak ada data...</td></tr>
                    @endforelse
                </tbody>
            </table>

            {{ $kendaraans->withQueryString()->links() }}
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
</style>

<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
@endsection
