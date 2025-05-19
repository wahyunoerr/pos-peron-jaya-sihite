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
        'harga_jual_per_kg',
        'total_harga_jual',
        'supir_id',
        'upah_supir',
        'nama_kerusakan',
        'biaya_kerusakan',
    ];

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class);
    }

    public function riwayatSortir()
    {
        return $this->hasOne(RiwayatSortir::class, 'sortir_id', 'sortir_id');
    }

    public function supir()
    {
        return $this->belongsTo(Supir::class);
    }

    public function detailKerusakans()
    {
        return $this->hasMany(DetailKerusakan::class);
    }
}
