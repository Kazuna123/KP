<?php

namespace App\Exports;

use App\Models\Peminjaman;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PeminjamanExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Peminjaman::with(['pegawai', 'kendaraan'])->get()->map(function ($p) {
            return [
                $p->pegawai->nama,
                $p->pegawai->nip,
                $p->kendaraan->nomor_polisi,
                $p->kendaraan->merk . ' / ' . $p->kendaraan->tipe,
                $p->tanggal_pinjam,
                $p->tanggal_kembali,
                $p->status,
                $p->keterangan,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Pegawai',
            'NIP',
            'No Polisi',
            'Merk / Tipe',
            'Tanggal Pinjam',
            'Tanggal Kembali',
            'Status',
            'Keterangan',
        ];
    }
}
