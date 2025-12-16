@extends('layouts.app')

@section('content')
<div class="container-fluid px-4 animate-page">

    <h3 class="mb-4 fw-bold title-header">Edit Pegawai</h3>

    <div class="card p-4 border-0 shadow-section fade-up">
        <form action="{{ route('pegawai.update', $pegawai->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row g-3">

                <div class="col-md-4">
                    <label class="fw-semibold">NIP</label>
                    <input type="text" name="nip" class="form-control"
                        value="{{ old('nip', $pegawai->nip) }}" required>
                </div>

                <div class="col-md-4">
                    <label class="fw-semibold">Nama</label>
                    <input type="text" name="nama" class="form-control"
                        value="{{ old('nama', $pegawai->nama) }}" required>
                </div>

                <div class="col-md-4">
                    <label class="fw-semibold">Jabatan</label>
                    <input type="text" name="jabatan" class="form-control"
                        value="{{ old('jabatan', $pegawai->jabatan) }}">
                </div>

                <div class="col-md-4">
                    <label class="fw-semibold">Email</label>
                    <input type="email" name="email" class="form-control"
                        value="{{ old('email', $pegawai->email) }}">
                </div>

                <div class="col-md-4">
                    <label class="fw-semibold">Telepon</label>
                    <input type="text" name="telepon" class="form-control"
                        value="{{ old('telepon', $pegawai->telepon) }}">
                </div>

                <div class="col-md-12">
                    <label class="fw-semibold">Alamat</label>
                    <textarea name="alamat" class="form-control" rows="3">{{ old('alamat', $pegawai->alamat) }}</textarea>
                </div>

            </div>

            <div class="mt-4 d-flex gap-2">
                <button class="btn btn-success shadow-btn">
                    <i class="bi bi-save"></i> Perbarui
                </button>
                <a href="{{ route('pegawai.index') }}" class="btn btn-secondary shadow-btn">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
            </div>
        </form>
    </div>

</div>

<style>
.title-header {
    color: #44322f;
}

/* ANIMASI */
.animate-page { animation: fadeIn .6s ease-in-out; }
.fade-up { animation: fadeUp .8s ease both; }

@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}
@keyframes fadeUp {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

/* CARD STYLE */
.shadow-section {
    border-radius: 14px;
    background: #fff;
    box-shadow: 0 4px 14px rgba(0,0,0,0.08);
}

/* Button Style */
.shadow-btn {
    font-weight: bold;
    border-radius: 10px;
    transition: .2s;
}
.shadow-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0,0,0,.2);
}
</style>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
@endsection
