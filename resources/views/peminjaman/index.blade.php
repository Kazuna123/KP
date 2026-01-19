@extends('layouts.app')


@section('content')
<div class="container-fluid px-4 animate-page">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold mb-0">
            <i class="bi bi-arrow-left-right me-2"></i> Pemakaian Kendaraan
        </h3>
    </div>

    {{-- FORM INPUT PEMINJAMAN --}}
    <div class="card mb-4 p-4 border-0 shadow-section fade-up">
        <form action="{{ route('peminjaman.store') }}" method="POST">
            @csrf

            <div class="row g-3">
                <div class="col-md-4">
                    <label class="fw-semibold">Pegawai</label>
                    <select name="pegawai_id" class="form-select select-search" required>
                        <option value="">-- Pilih / Search Pegawai --</option>
                        @foreach($pegawais as $p)
                            <option value="{{ $p->id }}">
                                {{ $p->nama }} ({{ $p->nip }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4">
                    <label class="fw-semibold">Kendaraan</label>
                    <select name="kendaraan_id" class="form-select select-search" required>
                        <option value="">-- Pilih / Search Kendaraan --</option>
                        @foreach($kendaraans as $k)
                            <option value="{{ $k->id }}" {{ $k->status != 'tersedia' ? 'disabled' : '' }}>
                                {{ $k->nomor_polisi }} — {{ $k->merk }} / {{ $k->tipe }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-2">
                    <label class="fw-semibold">Tgl. Pinjam</label>
                    <input type="date" name="tanggal_pinjam" class="form-control"
                           value="{{ date('Y-m-d') }}" required>
                </div>

                <div class="col-md-2">
                    <label class="fw-semibold">Tgl. Kembali</label>
                    <input type="date" name="tanggal_kembali" class="form-control"
                           value="{{ date('Y-m-d') }}" required>
                </div>

                <div class="col-md-12">
                    <label class="fw-semibold">Keterangan</label>
                    <textarea name="keterangan" class="form-control" rows="2"
                        placeholder="Contoh: Perjalanan dinas ke Surabaya"></textarea>
                </div>

                <div class="col-md-2 d-flex align-items-end">
                    <button class="btn btn-success w-100 shadow-btn">
                        <i class="bi bi-plus-circle me-1"></i> Pinjam
                    </button>
                </div>
            </div>
        </form>
    </div>

    {{-- TABEL PEMINJAMAN --}}
    <div class="card p-4 border-0 shadow-section fade-up delay-1">
        <div class="d-flex justify-content-end mb-3">
            <a href="{{ route('peminjaman.export') }}"
               class="btn btn-success shadow-btn">
                <i class="bi bi-file-earmark-excel me-1"></i> Export Excel
            </a>
        </div>
        <div class="table-responsive">
            <table class="table table-hover table-striped align-middle text-center">
                <thead class="table-header">
                    <tr>
                        <th>#</th>
                        <th>Pegawai</th>
                        <th>NIP</th>
                        <th>No. Polisi</th>
                        <th>Merk / Tipe</th>
                        <th>Tgl Pinjam</th>
                        <th>Tgl Kembali</th>
                        <th>Status</th>
                        <th>Keterangan</th>
                        <th width="150">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                @forelse($peminjamans as $pm)
                <tr class="row-hover">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $pm->pegawai->nama }}</td>
                    <td>{{ $pm->pegawai->nip }}</td>
                    <td>{{ $pm->kendaraan->nomor_polisi }}</td>
                    <td>{{ $pm->kendaraan->merk }} / {{ $pm->kendaraan->tipe }}</td>
                    <td>{{ $pm->tanggal_pinjam }}</td>
                    <td>{{ $pm->tanggal_kembali ?? '-' }}</td>

                    <td>
                        <span class="badge status-badge {{ $pm->status }}">
                            {{ ucfirst($pm->status) }}
                        </span>
                    </td>

                    <td>{{ \Illuminate\Support\Str::limit($pm->keterangan, 40) }}</td>

                    <td>
                        <div class="action-buttons d-flex justify-content-center gap-2">

                            @if($pm->status === 'dipinjam')
                            <form action="{{ route('peminjaman.selesai', $pm->id) }}" method="POST">
                                @csrf
                                <button class="btn-card btn-green"
                                        data-bs-toggle="tooltip"
                                        data-bs-placement="left"
                                        title="Selesaikan Pemakaian">
                                    <i class="bi bi-check-circle"></i>
                                </button>
                            </form>
                            @endif

                            <a href="{{ route('peminjaman.edit', $pm->id) }}"
                                class="btn-card btn-yellow"
                                data-bs-toggle="tooltip"
                                data-bs-placement="left"
                                title="Edit Data">
                                <i class="bi bi-pencil-square"></i>
                             </a>

                            <form action="{{ route('peminjaman.destroy', $pm->id) }}" method="POST">
                                @csrf @method('DELETE')
                                <button type="button"
                                        class="btn-card btn-red"
                                        data-bs-toggle="tooltip"
                                        data-bs-placement="left"
                                        title="Hapus Data Pemakaian"
                                        onclick="hapusPeminjaman('{{ route('peminjaman.destroy', $pm->id) }}')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>

                            <button class="btn-card btn-blue"
                                    data-bs-toggle="tooltip"
                                    data-bs-placement="left"
                                    title="Cetak Data"
                                    onclick="openCetak({{ $pm->id }})">
                                <i class="bi bi-printer"></i>
                            </button>

                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="10" class="text-muted">Tidak ada data...</td></tr>
                @endforelse
                </tbody>
            </table>

            {{ $peminjamans->links() }}
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
                        Apakah Anda yakin ingin menghapus data peminjaman ini?
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

{{-- SWEETALERT2 --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
function openCetak(id) {
    Swal.fire({
        title: 'Input Data Surat',
        html: `
            <div class="text-start">
                <label>Nomor Surat</label>
                <input id="nomor_surat" class="swal2-input" placeholder="Contoh: 123/ABC/2024">

                <label>Tanggal Surat</label>
                <input id="tanggal_surat" type="date" class="swal2-input"
                    value="${new Date().toISOString().slice(0, 10)}">

                <label>Nama Sekretaris</label>
                <input id="sekretaris" class="swal2-input" value="Sekretaris A">
            </div>
        `,
        confirmButtonText: 'Cetak Surat',
        showCancelButton: true,
        cancelButtonText: 'Batal',
        width: "450px",
        padding: "1.8rem",
        customClass: {
            popup: 'rounded-4 shadow-lg'
        },
        preConfirm: () => {
            return {
                nomor: document.getElementById('nomor_surat').value,
                tanggal: document.getElementById('tanggal_surat').value,
                sekretaris: document.getElementById('sekretaris').value
            }
        }
    }).then((result) => {
        if (result.isConfirmed) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = `/peminjaman/${id}/cetak`;
            form.style.display = 'none';

            form.innerHTML = `
                @csrf
                <input type="hidden" name="nomor_surat" value="${result.value.nomor}">
                <input type="hidden" name="tanggal_surat" value="${result.value.tanggal}">
                <input type="hidden" name="sekretaris" value="${result.value.sekretaris}">
            `;

            document.body.appendChild(form);
            form.submit();
        }
    });
}
</script>

<style>
/* HEADER */
.title-header {
    color: #44322f;
    font-size: 26px;
}

/* ANIMASI */
.animate-page { animation: fadeIn .6s ease-in-out; }
.fade-up { animation: fadeUp .8s ease both; }
.delay-1 { animation-delay: .15s; }

@keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
@keyframes fadeUp { from { opacity:0; transform:translateY(20px);} to {opacity:1; transform:translateY(0);} }

/* CARD */
.shadow-section {
    border-radius: 14px;
    background: #ffffff;
    box-shadow: 0 4px 14px rgba(0,0,0,0.07);
}

/* TABEL */
.table-header {
    background: #a6785d !important;
    color: #fff;
    font-weight: 600;
}

.row-hover:hover {
    background: #f7f2ee !important;
    transition: .2s;
}

/* BADGE */
.status-badge {
    padding: 6px 12px;
    font-size: 12px;
    border-radius: 6px;
}
.status-badge.dipinjam { background: #f5e05e; color:#3a2e00; }
.status-badge.selesai { background: #3cb878; color:#fff; }
.status-badge.dibatalkan { background: #b3b3b3; color:#fff; }

/* BUTTON */
.btn-card {
    width: 100%;
    height: 36px;
    border-radius: 10px;
    border: none;
    font-weight: bold;
    font-size: 14px;
    background: #fff;
    box-shadow: 0 3px 10px rgba(0,0,0,.15);
    transition: .2s;
}
.btn-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 6px 14px rgba(0,0,0,.2);
}
.btn-yellow { color: #d39e00; }
.btn-red { color: #d9534f; }
.btn-green { color: #28a745; }
.btn-blue { color: #0275d8; }

/* Fix input search Select2 */
.select2-container--default .select2-search--dropdown .select2-search__field {
    color: #212529 !important;      /* warna teks */
    background-color: #fff !important;
    border: 1px solid #ced4da;
    padding: 6px 10px;
    font-size: 14px;
}

/* Placeholder */
.select2-container--default .select2-search__field::placeholder {
    color: #6c757d;
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
    background: #262626 ;
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
        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
        tooltipTriggerList.forEach(el => {
            new bootstrap.Tooltip(el);
        });
    });

    $(document).ready(function () {
        $('.select-search').select2({
            width: '100%',
            placeholder: 'Ketik untuk mencari...'
        });
    });

    function hapusPeminjaman(url) {
        const form = document.getElementById('formHapus');
        form.action = url;

        const modal = new bootstrap.Modal(document.getElementById('hapusModal'));
        modal.show();
    }
</script>



@endsection
