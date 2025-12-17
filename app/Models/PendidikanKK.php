<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendidikanKK extends Model
{
    use HasFactory;

    protected $table = 'pendidikan_kk';

    protected $fillable = ['kelompok','jumlah'];
}
