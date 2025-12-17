<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wilayah extends Model
{
    use HasFactory;

    protected $table = 'wilayah'; // biar gak dicari jadi "wilayahs"

    protected $fillable = [
        'nama',
        'tingkat',
        'ketua',
        'kk',
        'l',
        'p',
        'parent_id',
    ];

    // 🔑 Relasi ke parent (Dusun/RW)
    public function parent()
    {
        return $this->belongsTo(Wilayah::class, 'parent_id');
    }

    // 🔑 Relasi ke children (RW/RT)
    public function children()
    {
        return $this->hasMany(Wilayah::class, 'parent_id');
    }

    // 🔑 Getter total
    public function getTotalAttribute()
    {
        return $this->l + $this->p;
    }
}
