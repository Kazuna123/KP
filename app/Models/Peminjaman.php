<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    protected $table = 'peminjaman';

    protected $fillable = [
        'pegawai_id',
        'jenis',
        'kendaraan_id',
        'tanggal_pinjam',
        'tanggal_kembali',
        'keterangan',
        'status',
        'user_id',
    ];

    public function pegawai()
    {
        return $this->belongsTo(\App\Models\Pegawai::class, 'pegawai_id');
    }

    public function kendaraan()
    {
        return $this->belongsTo(\App\Models\Kendaraan::class, 'kendaraan_id');
    }
}
