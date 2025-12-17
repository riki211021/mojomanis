<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArtikelPhoto extends Model
{
    use HasFactory;

    protected $fillable = ['artikel_id', 'foto'];

    public function artikel()
    {
        return $this->belongsTo(Artikel::class);
    }
}
