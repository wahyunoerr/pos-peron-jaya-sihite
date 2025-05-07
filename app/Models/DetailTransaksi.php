<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTransaksi extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaksi_id',
        'nama_pabrik',
        'sortir_id',
        'harga_jual',
    ];

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class);
    }

    public function riwayatSortir()
    {
        return $this->hasOne(RiwayatSortir::class, 'sortir_id', 'sortir_id');
    }
}
