<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendidikanDitempuh extends Model
{
    use HasFactory;

    protected $table = 'pendidikan_ditempuh'; // kalau nama tabel bukan jamak default
    protected $primaryKey = 'id';             // default sudah 'id'
    public $timestamps = false;               // matikan kalau tabel tidak ada created_at, updated_at

    protected $fillable = [
        'kode',
        'kelompok',
        'jumlah',
    ];
}
