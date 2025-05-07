<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supir extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'noTelp', 'alamat', 'status', 'truk_id', 'fotoSupir'];

    public function truk()
    {
        return $this->belongsTo(Truk::class);
    }
}
