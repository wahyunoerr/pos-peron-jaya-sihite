<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailKerusakan extends Model
{
    use HasFactory;

    protected $fillable = [
        'detail_transaksi_id',
        'nama_kerusakan',
        'biaya_kerusakan',
    ];

    public function detailTransaksi()
    {
        return $this->belongsTo(DetailTransaksi::class);
    }
}
