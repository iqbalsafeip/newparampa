<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataMarket extends Model
{
    use HasFactory;

    public function kecamatan(){
        return $this->belongsTo(Kecamatan::class, 'id_kecamatan');
    }

    public function gambar(){
        return $this->hasMany(ImageMarket::class, 'id_market');
    }
}
