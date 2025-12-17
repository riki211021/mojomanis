<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ArtikelPhoto;

class Artikel extends Model
{
    use HasFactory;

    protected $fillable = ['judul','subjudul','isi','gambar','penulis'];

    public function photos()
    {
        return $this->hasMany(ArtikelPhoto::class);
    }
}
