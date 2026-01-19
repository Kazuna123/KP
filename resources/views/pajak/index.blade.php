@extends('layouts.app')

@section('content')
<div class="container-fluid px-4 fade-in">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold mb-0">
            <i class="bi bi-receipt me-2"></i> Pajak Kendaraan
        </h3>
    </div>

    {{-- DROPDOWN PILIH KENDARAAN --}}
    <form method="GET" action="{{ route('pajak.index') }}" class="mb-4">
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

    {{-- INFO KENDARAAN --}}
    @if($kendaraan)
        <div class="alert alert-info shadow-sm">
            Menampilkan pajak untuk:
            <strong>{{ $kendaraan->merk }} {{ $kendaraan->tipe }}</strong>
            ({{ $kendaraan->nomor_polisi }})
        </div>
    @else
        <div class="alert alert-secondary shadow-sm">
            Menampilkan <strong>semua</strong> data pajak kendaraan
        </div>
    @endif

    {{-- FORM TAMBAH PAJAK --}}
    {{-- FORM TAMBAH PAJAK --}}
    @if($kendaraan)
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body p-4">

            <h5 class="fw-semibold mb-3">
                <i class="bi bi-plus-circle me-1"></i> Tambah Pajak Kendaraan
            </h5>

            <form action="{{ route('pajak.store') }}" method="POST">
                @csrf
                <input type="hidden"
                    name="kendaraan_id"
                    value="{{ $kendaraan->id }}">

                <div class="row g-3">

                    {{-- JENIS PAJAK --}}
                    <div class="col-md-4">
                        <label class="fw-semibold">Jenis Pajak</label>
                        <select name="jenis" class="form-select" required>
                            <option value="">-- Pilih Jenis --</option>
                            <option value="tahunan">Pajak Tahunan</option>
                            <option value="lima_tahunan">Pajak 5 Tahunan</option>
                        </select>
                    </div>

                    {{-- TANGGAL BAYAR --}}
                    <div class="col-md-4">
                        <label class="fw-semibold">Tanggal Bayar</label>
                        <input type="date"
                            name="tanggal_bayar"
                            class="form-control"
                            required>
                    </div>

                    {{-- TANGGAL JATUH TEMPO --}}
                    <div class="col-md-4">
                        <label class="fw-semibold">Tanggal Jatuh Tempo</label>
                        <input type="date"
                            name="tanggal_jatuh_tempo"
                            class="form-control"
                            required>
                    </div>

                    {{-- SUBMIT --}}
                    <div class="col-md-12 text-end mt-3">
                        <button class="btn btn-success px-4">
                            <i class="bi bi-save me-1"></i> Simpan Pajak
                        </button>
                    </div>

                </div>
            </form>

        </div>
    </div>
    @endif

    {{-- TABEL RIWAYAT PAJAK --}}
    <div class="card shadow-sm border-0">
        <div class="card-body p-4">
            <h5 class="fw-semibold mb-3">Riwayat Pajak Kendaraan</h5>

            <div class="table-responsive">
                <table class="table table-hover align-middle text-center">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Kendaraan</th>
                            <th>Jenis</th>
                            <th>Tgl Bayar</th>
                            <th>Jatuh Tempo</th>
                            <th>Status</th>
                            <th width="120">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pajaks as $p)
                        @php
                            $jatuhTempo = \Carbon\Carbon::parse($p->tanggal_jatuh_tempo);
                            $sisaHari = now()->diffInDays($jatuhTempo, false);
                        @endphp
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                        
                            <td>
                                {{ $p->kendaraan->merk ?? '-' }}
                                {{ $p->kendaraan->tipe ?? '' }}<br>
                                <small class="text-muted">
                                    {{ $p->kendaraan->nomor_polisi ?? '-' }}
                                </small>
                            </td>
                        
                            <td>
                                <span class="badge bg-info">
                                    {{ $p->jenis === 'tahunan' ? 'Tahunan' : '5 Tahunan' }}
                                </span>
                            </td>
                        
                            {{-- TANGGAL BAYAR --}}
                            <td>
                                {{ \Carbon\Carbon::parse($p->tanggal_bayar)
                                    ->translatedFormat('d F Y') }}
                            </td>
                        
                            {{-- JATUH TEMPO --}}
                            <td>
                                {{ $jatuhTempo->translatedFormat('d F Y') }}<br>
                        
                                <small class="text-muted">
                                    Pajak berlaku sampai tanggal ini
                                </small>
                            </td>
                        
                            {{-- STATUS --}}
                            <td>
                                @if($sisaHari < 0)
                                    <span class="badge bg-danger">Kadaluarsa</span>
                                @elseif($sisaHari <= 30)
                                    <span class="badge bg-warning text-dark">
                                        Akan Jatuh Tempo
                                    </span>
                                @else
                                    <span class="badge bg-success">Aktif</span>
                                @endif
                            </td>
                        
                            {{-- AKSI --}}
                            <td>
                                <a href="{{ route('pajak.edit', $p->id) }}"
                                    class="btn btn-soft-warning btn-sm mb-1">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                 
                                <form action="{{ route('pajak.destroy', $p->id) }}"
                                      method="POST"
                                      class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-soft-danger btn-sm"
                                            onclick="return confirm('Hapus data pajak ini?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-muted text-center">
                                Belum ada data pajak kendaraan
                            </td>
                        </tr>
                        @endforelse
                    </tbody>                        
                </table>
            </div>
        </div>
    </div>

</div>
@endsection
