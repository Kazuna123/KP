<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArsipSurat extends Model
{
    use HasFactory;

    protected $table = 'arsip_surat';

    protected $fillable = [
        'kendaraan_id',
        'jenis',
        'nomor_surat',
        'tanggal_surat',
        'sekretaris',
        'user_id'
    ];

    public function kendaraan()
    {
        return $this->belongsTo(\App\Models\Kendaraan::class, 'kendaraan_id');
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }
}
