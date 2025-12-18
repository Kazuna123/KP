<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kendaraan extends Model
{
    use HasFactory;

    protected $table = 'kendaraan'; // jika berbeda, sesuaikan

    protected $fillable = [
        'pegawai_id',
        'jenis', 
        'nomor_polisi',
        'merk',
        'tipe',
        'tahun',
        'status',
        'nomor_rangka',
        'nomor_mesin',
        'fungsi',
        'ket'
    ];

    public function pegawai()
    {
        return $this->belongsTo(\App\Models\Pegawai::class, 'pegawai_id');
    }
}
