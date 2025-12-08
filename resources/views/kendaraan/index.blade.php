@extends('layouts.app')

@section('content')
<div class="container">

    <h3 class="mb-3">Data Kendaraan</h3>

    {{-- ===================== --}}
    {{-- FORM INPUT / EDIT --}}
    {{-- ===================== --}}
    <div class="card mb-4 p-3 border-0 shadow-sm">
        <form id="formKendaraan" method="POST" action="{{ route('kendaraan.store') }}">
            @csrf

    <div class="row g-3">

        {{-- Pegawai --}}
        <div class="col-md-4">
            <label class="fw-semibold">Nama Pegawai</label>
            <select name="pegawai_id" id="pegawai_id" class="form-control">
                <option value="">-- Pilih Pegawai --</option>
                @foreach(\App\Models\Pegawai::all() as $pg)
                <option value="{{ $pg->id }}">{{ $pg->nama }} ({{ $pg->nip }})</option>
                @endforeach
            </select>
        </div>

        {{-- Jenis Kendaraan --}}
        <div class="col-md-4">
            <label class="fw-semibold">Jenis Kendaraan</label>
            <input type="text" name="jenis" id="jenis" class="form-control" placeholder="Contoh: Roda 4 / Roda 2">
        </div>

        {{-- Nomor Polisi --}}
        <div class="col-md-4">
            <label class="fw-semibold">Nomor Polisi</label>
            <input type="text" name="nomor_polisi" id="nomor_polisi" class="form-control">
        </div>

        {{-- Merk --}}
        <div class="col-md-4">
            <label class="fw-semibold">Merk</label>
            <input type="text" name="merk" id="merk" class="form-control">
        </div>

        {{-- Tipe --}}
        <div class="col-md-4">
            <label class="fw-semibold">Tipe</label>
            <input type="text" name="tipe" id="tipe" class="form-control">
        </div>

        {{-- Tahun --}}
        <div class="col-md-4">
            <label class="fw-semibold">Tahun (Dalam Angka)</label>
            <input type="number" name="tahun" id="tahun" class="form-control">
        </div>

        {{-- Nomor Rangka --}}
        <div class="col-md-4">
            <label class="fw-semibold">Nomor Rangka</label>
            <input type="text" name="nomor_rangka" id="nomor_rangka" class="form-control">
        </div>

        {{-- Nomor Mesin --}}
        <div class="col-md-4">
            <label class="fw-semibold">Nomor Mesin</label>
            <input type="text" name="nomor_mesin" id="nomor_mesin" class="form-control">
        </div>

        {{-- Fungsi --}}
        <div class="col-md-4">
            <label class="fw-semibold">Fungsi</label>
            <input type="text" name="fungsi" id="fungsi" class="form-control" placeholder="Contoh: Operasional kantor">
        </div>

        {{-- Keterangan --}}
        <div class="col-md-12">
            <label class="fw-semibold">Keterangan</label>
            <textarea name="ket" id="ket" class="form-control" rows="2"></textarea>
        </div>

        {{-- Status --}}
        <div class="col-md-4">
            <label class="fw-semibold">Status</label>
            <select name="status" id="status" class="form-control">
                <option value="tersedia">Tersedia</option>
                <option value="dipinjam">Dipinjam</option>
                <option value="maintenance">Maintenance</option>
            </select>
        </div>

    </div>


            <div class="mt-3">
                <button class="btn btn-success">Tambah / Perbarui</button>
                <button type="button" id="btnClear" class="btn btn-secondary">Kosongi Isian</button>
            </div>
        </form>
    </div>

    {{-- ===================== --}}
    {{-- FILTER PENCARIAN --}}
    {{-- ===================== --}}
    <form method="GET" action="{{ route('kendaraan.index') }}" class="mb-3">
        <div class="input-group">
            <input name="q" value="{{ request('q') }}" class="form-control" placeholder="Cari nama / nip pegawai / nopol / merk / tipe">
            <button class="btn btn-primary">Cari</button>
        </div>
    </form>

    {{-- ===================== --}}
    {{-- TABEL HASIL PENCARIAN --}}
    {{-- ===================== --}}
    <div class="card p-3 border-0 shadow-sm">
    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
           <thead class="bg-brown text-white" style="background:#b48b75; color:white;">
                <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>NIP</th>
                    <th>Jabatan</th>
                    <th>Jenis</th>
                    <th>Nopol</th>
                    <th>Merk / Tipe</th>
                    <th>Tahun</th>
                    <th>No. Rangka</th>
                    <th>No. Mesin</th>
                    <th>Fungsi</th>
                    <th>Keterangan</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
            @forelse($kendaraans as $k)
            <tr>
                <td>{{ $loop->iteration }}</td>

                {{-- Data Pegawai --}}
                <td>{{ $k->pegawai->nama ?? '-' }}</td>
                <td>{{ $k->pegawai->nip ?? '-' }}</td>
                <td>{{ $k->pegawai->jabatan ?? '-' }}</td>

                {{-- Data Kendaraan --}}
                <td>{{ $k->jenis ?? '-' }}</td>
                <td>{{ $k->nomor_polisi }}</td>
                <td>{{ $k->merk }} / {{ $k->tipe }}</td>
                <td>{{ $k->tahun }}</td>
                <td>{{ $k->nomor_rangka ?? '-' }}</td>
                <td>{{ $k->nomor_mesin ?? '-' }}</td>
                <td>{{ $k->fungsi ?? '-' }}</td>
                <td>{{ $k->ket ?? '-' }}</td>

                {{-- Tombol Aksi --}}
                <td class="text-center">
                <div class="d-flex flex-column gap-1">

                    {{-- Pilih --}}
                    <button class="btn btn-sm btn-primary w-100 btn-select"
                        data-kendaraan="{{ $k->id }}"
                        data-nopol="{{ $k->nomor_polisi }}">
                        Pilih
                    </button>

                    {{-- Edit --}}
                    <a href="{{ route('kendaraan.edit', $k->id) }}"
                        class="btn btn-sm btn-warning w-100">
                        Edit
                    </a>

                    {{-- Hapus --}}
                    <form action="{{ route('kendaraan.destroy', $k->id) }}"
                        method="POST" onsubmit="return confirm('Hapus data ini?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger w-100">
                            Hapus
                        </button>
                    </form>

                </div>
            </td>
            </tr>
            @empty
            <tr>
                <td colspan="13" class="text-center text-muted py-3">Tidak ada data ditemukan.</td>
            </tr>
            @endforelse
            </tbody>
        </table>
        <style>
            td .btn {
                font-size: 12px;
                padding: 5px 0;
            }
            td .btn:nth-child(1) { margin-top: 0; }
            td form { margin: 0; }
        </style>

        {{ $kendaraans->withQueryString()->links() }}

    </div>

    {{-- ===================== --}}
    {{-- PANEL CETAK SURAT --}}
    {{-- ===================== --}}
    <div class="card mt-4 p-3 border-0 shadow-sm">
        <h5>Cetak Surat</h5>

        <form id="formCetak" method="POST">
            @csrf
            <input type="hidden" name="kendaraan_id" id="p_kendaraan_id">

            <div class="row g-3">
                <div class="col-md-4">
                    <label>Nomor Surat</label>
                    <input type="text" name="nomor_surat" id="nomor_surat" class="form-control">
                </div>

                <div class="col-md-4">
                    <label>Tanggal Surat</label>
                    <input type="date" name="tanggal_surat" id="tanggal_surat" class="form-control" value="{{ date('Y-m-d') }}">
                </div>

                <div class="col-md-4">
                    <label>Sekretaris</label>
                    <select name="sekretaris" id="sekretaris" class="form-control">
                        @foreach($sekretaris as $s)
                        <option value="{{ $s }}">{{ $s }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="mt-3">
                {{-- <h6><b>Export Excel</b></h6>
                <button class="btn btn-success btn-export-pemutihan">Export Excel Pemutihan</button>
                <button class="btn btn-success btn-export-spbkb">Export Excel SPBKB</button> --}}

                <hr>

                <h6><b>Cetak PDF</b></h6>
                <button class="btn btn-primary btn-cetak-pemutihan">Cetak PDF Pemutihan</button>
                <button class="btn btn-primary btn-cetak-spbkb">Cetak PDF SPBKB</button>

            </div>
        </form>
    </div>

</div>

{{-- ===================== --}}
{{-- SCRIPT --}}
{{-- ===================== --}}
<script>

//
// PILIH KENDARAAN
//
document.querySelectorAll('.btn-select').forEach(btn => {
    btn.addEventListener('click', function(){
        let id = this.dataset.kendaraan;
        let nopol = this.dataset.nopol;

        document.getElementById("p_kendaraan_id").value = id;
        alert("Kendaraan dipilih: " + nopol);
    });
});

//
// FUNGSI GENERIK — untuk set action form
//
function submitForm(url) {
    let id = document.getElementById('p_kendaraan_id').value;
    if(!id){
        alert("Pilih data kendaraan dulu!");
        return;
    }

    let form = document.getElementById("formCetak");
    form.setAttribute("method", "POST");
    form.setAttribute("action", url.replace(':id', id));
    form.submit();
}

//
// EXPORT EXCEL PEMUTIHAN
//
// document.querySelector('.btn-export-pemutihan').addEventListener('click', function(e){
//     e.preventDefault();
//     submitForm("/kendaraan/:id/export-pemutihan");
// });

//
// EXPORT EXCEL SPBKB
//
// document.querySelector('.btn-export-spbkb').addEventListener('click', function(e){
//     e.preventDefault();
//     submitForm("/kendaraan/:id/export-spbkb");
// });

//
// CETAK PDF PEMUTIHAN
//
document.querySelector('.btn-cetak-pemutihan').addEventListener('click', function(e){
    e.preventDefault();
    submitForm("/kendaraan/:id/cetak-pemutihan");
});

//
// CETAK PDF SPBKB
//
document.querySelector('.btn-cetak-spbkb').addEventListener('click', function(e){
    e.preventDefault();
    submitForm("/kendaraan/:id/cetak-spbkb");
});

</script>

@endsection
