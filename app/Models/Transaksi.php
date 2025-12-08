<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaksi extends Model
{
    use HasFactory;
    protected $table = 'transaksi';
    protected $fillable = [
        'pegawai_id', 'kendaraan_id', 'jenis', 'tujuan',
        'tanggal_mulai', 'tanggal_selesai', 'status', 'keterangan'
    ];

    public function pegawai() { return $this->belongsTo(Pegawai::class); }
    public function kendaraan() { return $this->belongsTo(Kendaraan::class); }
    public function pencatatan() { return $this->hasMany(PencatatanTanggal::class); }
}
