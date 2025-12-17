<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    use HasFactory;

    protected $fillable = [
    'warga_id',
    'jenis_dokumen',
    'keterangan',
    'lampiran',
    'status',
    'catatan_admin',
    'lampiran_admin', // 👈 tambahkan ini kalau belum
];


    // Relasi ke tabel warga
    public function warga()
    {
        return $this->belongsTo(\App\Models\Warga::class, 'warga_id');
    }
}
