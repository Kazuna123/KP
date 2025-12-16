@extends('layouts.app')

@section('content')
<div class="container-fluid px-4 animate-page">

    <h3 class="mb-4 fw-bold title-header">Tambah Pegawai</h3>

    <div class="card p-4 border-0 shadow-section fade-up">
        <form action="{{ route('pegawai.store') }}" method="POST">
            @csrf

            <div class="row g-3">

                <div class="col-md-4">
                    <label class="fw-semibold">NIP</label>
                    <input type="text" name="nip" class="form-control" required>
                </div>

                <div class="col-md-4">
                    <label class="fw-semibold">Nama</label>
                    <input type="text" name="nama" class="form-control" required>
                </div>

                <div class="col-md-4">
                    <label class="fw-semibold">Jabatan</label>
                    <input type="text" name="jabatan" class="form-control">
                </div>

                <div class="col-md-4">
                    <label class="fw-semibold">Email</label>
                    <input type="email" name="email" class="form-control">
                </div>

                <div class="col-md-4">
                    <label class="fw-semibold">Telepon</label>
                    <input type="text" name="telepon" class="form-control">
                </div>

                <div class="col-md-12">
                    <label class="fw-semibold">Alamat</label>
                    <textarea name="alamat" rows="3" class="form-control"></textarea>
                </div>

            </div>

            <div class="mt-4 d-flex gap-2">
                <button class="btn btn-success shadow-btn">
                    <i class="bi bi-save"></i> Simpan
                </button>

                <a href="{{ route('pegawai.index') }}" class="btn btn-secondary shadow-btn">
                    <i class="bi bi-arrow-left"></i> Batal
                </a>
            </div>

        </form>
    </div>

</div>

{{-- ===== CSS CUSTOM agar selaras dengan tampilan lainnya ===== --}}
<style>
.title-header {
    color: #44322f;
}
.animate-page { animation: fadeIn .6s ease-in-out; }
.fade-up { animation: fadeUp .8s ease both; }

@keyframes fadeIn { from { opacity:0; } to { opacity:1; } }
@keyframes fadeUp { from { opacity:0; transform:translateY(20px);} to {opacity:1; transform:translateY(0);} }

.shadow-section {
    border-radius: 14px;
    background: #fff;
    box-shadow: 0 4px 14px rgba(0,0,0,0.08);
}

.shadow-btn {
    transition: .2s;
}
.shadow-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 6px 14px rgba(0,0,0,.2);
}
</style>

<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
@endsection
