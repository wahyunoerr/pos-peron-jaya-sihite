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
        $totalKeuntungan = 0;
        $grouped = $this->detailTransaksis->groupBy('transaksi_id');
        foreach ($grouped as $details) {
            $totalHargaJual = $details->first()->total_harga_jual ?? 0;
            $totalModal = 0;
            $totalUpahSupir = 0;
            $totalBiayaKerusakan = 0;
            foreach ($details as $detail) {
                if ($detail->riwayatSortir) {
                    $totalModal += $detail->riwayatSortir->harga * ($detail->riwayatSortir->timbangan_bersih ?? 0);
                }
                $totalUpahSupir += $detail->upah_supir ?? 0;
                if ($detail->detailKerusakans) {
                    $totalBiayaKerusakan += $detail->detailKerusakans->sum('biaya_kerusakan');
                }
            }
            $keuntungan = $totalHargaJual - $totalModal - $totalUpahSupir - $totalBiayaKerusakan;
            $totalKeuntungan += $keuntungan;
        }
        return $totalKeuntungan;
    }

    public function calculateTotalModal()
    {
        return $this->detailTransaksis->sum(function ($detail) {
            return $detail->riwayatSortir->harga * ($detail->riwayatSortir->timbangan_bersih ?? 0);
        });
    }

    public function supir()
    {
        return $this->belongsTo(Supir::class);
    }
}
