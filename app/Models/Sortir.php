<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sortir extends Model
{
    use HasFactory;

    protected $fillable = ['timbang_masuk', 'timbang_keluar', 'berat_kotor', 'status', 'jangkos', 'harga', 'presentase_id', 'penjual_id'];

    public function presentase()
    {
        return $this->belongsTo(Presentase::class);
    }

    public function penjual()
    {
        return $this->belongsTo(Penjual::class);
    }

    protected $appends = ['timbanganBersih'];

    public function getTimbanganBersihAttribute()
    {
        if ($this->status === 'bagus') {
            $potongan = $this->berat_kotor * ($this->presentase->name / 100);
            return $this->berat_kotor - $potongan;
        } else {
            $potongan = $this->berat_kotor * ($this->presentase->name / 100);
            return $this->berat_kotor - $potongan;
        }
    }

    public function getModalAttribute()
    {
        return $this->timbanganBersih * $this->harga;
    }
}
