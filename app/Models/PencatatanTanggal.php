<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class PencatatanTanggal extends Model
{
    use HasFactory;
    protected $table = 'pencatatan_tanggal';
    protected $fillable = ['transaksi_id', 'tanggal', 'catatan'];

    public function transaksi() { return $this->belongsTo(Transaksi::class); }
}
