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
        'ket',
        'nama_kendaraan',
        'kondisi',
        'foto_kendaraan',
        'foto_stnk'
    ];

    
    /*
    |--------------------------------------------------------------------------
    | RELATIONSHIPS
    |--------------------------------------------------------------------------
    */

    // 1 kendaraan punya banyak maintenance
    public function maintenance()
    {
        return $this->hasMany(MaintenanceKendaraan::class);
    }

    // 1 kendaraan punya banyak pajak
    public function pajak()
    {
        return $this->hasMany(PajakKendaraan::class);
    }
    public function pegawai()
    {
        return $this->belongsTo(\App\Models\Pegawai::class, 'pegawai_id');
    }
}
