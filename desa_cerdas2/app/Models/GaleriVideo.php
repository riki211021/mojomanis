<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GaleriVideo extends Model
{
    protected $table = 'galeri_video';

    protected $fillable = [
        'judul',
        'deskripsi',
        'thumbnail',
        'video',
        'link_youtube',
    ];
}
