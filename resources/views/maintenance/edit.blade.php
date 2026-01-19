@extends('layouts.app')

@section('content')
<div class="container-fluid px-4 fade-in">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold mb-0">
            <i class="bi bi-pencil-square me-2"></i> Edit Maintenance
        </h3>

        <span class="badge bg-secondary px-3 py-2">
            {{ $maintenance->kendaraan->nomor_polisi }}
        </span>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body p-4">

            <form action="{{ route('maintenance.update', $maintenance->id) }}"
                  method="POST">
                @csrf
                @method('PUT')

                <div class="row g-4">

                    {{-- INFO KENDARAAN --}}
                    <div class="col-md-12">
                        <label class="fw-semibold text-muted mb-1">Kendaraan</label>
                        <div class="form-control bg-light">
                            <strong>
                                {{ $maintenance->kendaraan->merk }}
                                {{ $maintenance->kendaraan->tipe }}
                            </strong>
                            <span class="text-muted">
                                ({{ $maintenance->kendaraan->nomor_polisi }})
                            </span>
                        </div>
                    </div>

                    {{-- TANGGAL --}}
                    <div class="col-md-4">
                        <label class="fw-semibold text-muted mb-1">
                            Tanggal Service
                        </label>
                        <input type="date"
                               name="tanggal"
                               class="form-control shadow-sm"
                               value="{{ $maintenance->tanggal }}"
                               required>
                    </div>

                    {{-- KETERANGAN --}}
                    <div class="col-md-8">
                        <label class="fw-semibold text-muted mb-1">
                            Keterangan Maintenance
                        </label>
                        <textarea name="keterangan"
                                  class="form-control shadow-sm"
                                  rows="3"
                                  placeholder="Contoh: Service rutin, ganti oli, dll">{{ $maintenance->keterangan }}</textarea>
                    </div>

                </div>

                {{-- ACTION BUTTON --}}
                <div class="d-flex justify-content-end gap-2 mt-4">

                    <a href="{{ route('maintenance.index') }}"
                       class="btn btn-soft-secondary px-4">
                        <i class="bi bi-arrow-left me-1"></i>
                        Kembali
                    </a>

                    <button class="btn btn-soft-success px-4">
                        <i class="bi bi-save me-1"></i>
                        Update
                    </button>

                </div>

            </form>

        </div>
    </div>

</div>
@endsection
