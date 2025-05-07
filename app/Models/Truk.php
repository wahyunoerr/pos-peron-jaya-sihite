<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Truk extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'noPlat', 'status'];

    public function supir()
    {
        return $this->belongsTo(Supir::class);
    }
}
