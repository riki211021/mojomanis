<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HasilProduk extends Model
{
    protected $fillable = [
        'dusun',
        'rt',
        'tahun',
        'produk',
        'musim_1',
        'musim_2',
        'musim_3',
        'total_tahun',
        'foto',
        'koordinat',
    ];
}
