<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;

    // Nama tabel
    protected $table = 'pegawai';

    // Kolom yang boleh diisi
    protected $fillable = [
        'nip',
        'nama',
        'jabatan',
        'email',
        'telepon',
        'alamat'
    ];

    /*
    |--------------------------------------------------------------------------
    | RELASI BARU: Pegawai -> Kendaraan
    |--------------------------------------------------------------------------
    | Satu pegawai bisa memiliki banyak kendaraan
    */
    public function kendaraans()
    {
        return $this->hasMany(Kendaraan::class, 'pegawai_id');
    }
}
