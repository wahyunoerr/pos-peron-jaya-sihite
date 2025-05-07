<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $fillable = ['kode_transaksi', 'tanggal_transaksi', 'jumlah_transaksi'];

    public function detailTransaksis()
    {
        return $this->hasMany(DetailTransaksi::class);
    }

    public function riwayatSortirs()
    {
        return $this->hasMany(RiwayatSortir::class, 'transaksi_id', 'id');
    }

    public function calculateProfitFromDetails()
    {
        $totalTimbanganBersih = $this->riwayatSortirs->sum('timbangan_bersih');
        $hargaJual = $this->riwayatSortirs->first()->harga;
        $modal = $totalTimbanganBersih * $hargaJual;
        $keuntungan = $modal - $hargaJual;

        return $keuntungan;
    }
}
