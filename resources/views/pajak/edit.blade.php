@extends('layouts.app')

@section('content')
<div class="container-fluid px-4 fade-in">

    <h4 class="fw-bold mb-4">
        <i class="bi bi-pencil-square me-1"></i> Edit Pajak Kendaraan
    </h4>

    <div class="card shadow-sm border-0">
        <div class="card-body p-4">

            <form action="{{ route('pajak.update', $pajak->id) }}"
                  method="POST">
                @csrf
                @method('PUT')

                <div class="row g-3">

                    <div class="col-md-4">
                        <label class="fw-semibold">Jenis Pajak</label>
                        <select name="jenis" class="form-select" required>
                            <option value="tahunan"
                                {{ $pajak->jenis === 'tahunan' ? 'selected' : '' }}>
                                Pajak Tahunan
                            </option>
                            <option value="lima_tahunan"
                                {{ $pajak->jenis === 'lima_tahunan' ? 'selected' : '' }}>
                                Pajak 5 Tahunan
                            </option>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label class="fw-semibold">Tanggal Bayar</label>
                        <input type="date"
                               name="tanggal_bayar"
                               value="{{ $pajak->tanggal_bayar }}"
                               class="form-control"
                               required>
                    </div>

                    <div class="col-md-4">
                        <label class="fw-semibold">Tanggal Jatuh Tempo</label>
                        <input type="date"
                               name="tanggal_jatuh_tempo"
                               value="{{ $pajak->tanggal_jatuh_tempo }}"
                               class="form-control"
                               required>
                    </div>

                    <div class="col-md-12 text-end mt-3">
                        <a href="{{ route('pajak.index') }}"
                           class="btn btn-secondary me-2">
                            Kembali
                        </a>

                        <button class="btn btn-primary px-4">
                            <i class="bi bi-save me-1"></i> Update Pajak
                        </button>
                    </div>

                </div>
            </form>

        </div>
    </div>

</div>
@endsection
