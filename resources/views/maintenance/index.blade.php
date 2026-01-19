@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">

    <h3 class="mb-4 fw-bold">
        <i class="bi bi-tools me-2"></i> Maintenance Kendaraan
    </h3>    

    {{-- DROPDOWN PILIH KENDARAAN --}}
    <form method="GET" action="{{ route('maintenance.index') }}" class="mb-4">
        <label class="mb-1 text-muted fw-semibold">Filter Kendaraan</label>
            <select name="kendaraan_id"
                    class="form-select select2 shadow-sm"
                    onchange="this.form.submit()">        
            <option value="">-- Semua Kendaraan --</option>

            @foreach($kendaraans as $k)
                <option value="{{ $k->id }}"
                    {{ request('kendaraan_id') == $k->id ? 'selected' : '' }}>
                    {{ $k->merk }} {{ $k->tipe }} - {{ $k->nomor_polisi }}
                </option>
            @endforeach
        </select>
    </form>

    {{-- INFO FILTER --}}
    @if($kendaraan)
        <div class="alert alert-info">
            Menampilkan maintenance untuk:
            <strong>{{ $kendaraan->merk }} {{ $kendaraan->tipe }}</strong>
            ({{ $kendaraan->nomor_polisi }})
        </div>
    @else
        <div class="alert alert-secondary">
            Menampilkan <strong>semua</strong> data maintenance kendaraan
        </div>
    @endif

    {{-- FORM TAMBAH MAINTENANCE (HANYA JIKA PILIH KENDARAAN) --}}
    @if($kendaraan)
    <div class="card mb-4 p-4 shadow-sm">
        <h5 class="mb-3">Tambah Maintenance</h5>

        <form action="{{ route('maintenance.store') }}" method="POST">
            @csrf
            <input type="hidden" name="kendaraan_id" value="{{ $kendaraan->id }}">

            <div class="row g-3">
                <div class="col-md-4">
                    <label>Tanggal Service</label>
                    <input type="date" name="tanggal" class="form-control" required>
                </div>

                <div class="col-md-8">
                    <label>Keterangan</label>
                    <textarea name="keterangan"
                              class="form-control"
                              rows="2"
                              placeholder="Service rutin / ganti oli / perbaikan"></textarea>
                </div>

                <div class="col-md-12 text-end">
                    <button class="btn btn-soft-success px-4">
                        <i class="fa-solid fa-floppy-disk me-1"></i>
                        Simpan Maintenance
                    </button>                    
                </div>
            </div>
        </form>
    </div>
    @endif

    {{-- TABEL RIWAYAT MAINTENANCE (SELALU MUNCUL) --}}
    <div class="card p-4 shadow-sm">
        <h5 class="mb-3">Riwayat Maintenance</h5>

        <div class="table-responsive">
            <table class="table table-hover table-striped align-middle text-center">
                <thead class="table-heade">
                    <tr>
                        <th>No</th>
                        <th>Kendaraan</th>
                        <th>Tanggal</th>
                        <th>Keterangan</th>
                        <th width="100">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($maintenances as $m)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            {{ $m->kendaraan->merk ?? '-' }}
                            {{ $m->kendaraan->tipe ?? '' }} <br>
                            <small class="text-muted">
                                {{ $m->kendaraan->nomor_polisi ?? '-' }}
                            </small>
                        </td>
                        <td>{{ $m->tanggal }}</td>
                        <td>{{ $m->keterangan }}</td>
                        <td>
                            <div class="action-btn">
                                <a href="{{ route('maintenance.edit', $m->id) }}"
                                   class="btn btn-soft-warning btn-sm"
                                   title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                        
                                <form action="{{ route('maintenance.destroy', $m->id) }}"
                                      method="POST"
                                      onsubmit="return confirm('Yakin ingin menghapus data maintenance ini?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-soft-danger btn-sm" title="Hapus">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                        
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-muted">
                            Belum ada data maintenance
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<style>
    /* CARD */
    .card {
        border-radius: 14px;
        border: none;
    }
    
    /* TABLE */
    .table thead th {
        font-size: 13px;
        text-transform: uppercase;
        letter-spacing: .04em;
    }
    
    .table tbody tr {
        transition: all .25s ease;
    }
    
    .table tbody tr:hover {
        background-color: #f8f9fa;
        transform: scale(1.005);
    }
    
    /* BUTTON SOFT */
    .btn-soft-success {
        background: rgba(25, 135, 84, 0.15);
        color: #198754;
        border: none;
        transition: .25s;
    }
    .btn-soft-success:hover {
        background: #198754;
        color: #fff;
    }
    
    .btn-soft-warning {
        background: rgba(255, 193, 7, 0.2);
        color: #856404;
        border: none;
    }
    .btn-soft-warning:hover {
        background: #ffc107;
        color: #000;
    }
    
    .btn-soft-danger {
        background: rgba(220, 53, 69, 0.2);
        color: #842029;
        border: none;
    }
    .btn-soft-danger:hover {
        background: #dc3545;
        color: #fff;
    }
    
    /* ACTION BUTTON GROUP */
    .action-btn {
        display: flex;
        gap: 6px;
        justify-content: center;
    }
    
    /* SMOOTH FADE */
    .fade-in {
        animation: fadeIn .4s ease-in-out;
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(6px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>
    
@endsection
