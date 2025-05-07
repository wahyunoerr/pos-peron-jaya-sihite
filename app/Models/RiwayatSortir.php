<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatSortir extends Model
{
    use HasFactory;

    protected $fillable = [
        'sortir_id',
        'timbang_masuk',
        'timbang_keluar',
        'berat_kotor',
        'status',
        'jangkos',
        'harga',
        'timbangan_bersih',
        'presentase_id',
        'penjual_id',
        'transaksi_id',
    ];

    public function presentase()
    {
        return $this->belongsTo(Presentase::class);
    }

    public function penjual()
    {
        return $this->belongsTo(Penjual::class);
    }

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class);
    }
}
