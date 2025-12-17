<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profil extends Model
{
    use HasFactory;

    protected $table = 'profils'; // nama tabel

    // field yang boleh diisi
    protected $fillable = [
        'judul',
        'sejarah',
        'visi',
        'misi',
        'struktur',
        'potensi',
        'peta',
        'foto_sejarah', // 🆕 tambahkan ini
    ];
}
