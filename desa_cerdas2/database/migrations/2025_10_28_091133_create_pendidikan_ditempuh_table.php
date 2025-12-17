<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pendidikan_ditempuh', function (Blueprint $table) {
            $table->id();
            $table->string('kode')->nullable(); // boleh kosong
            $table->string('kelompok');         // nama kelompok pendidikan
            $table->integer('jumlah');          // jumlah data
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pendidikan_ditempuh');
    }
};
