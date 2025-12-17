<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pertanians', function (Blueprint $table) {
            $table->id();
            $table->string('dusun');
            $table->string('rt');
            $table->year('tahun');
            $table->string('jenis_tanaman');
            $table->integer('hasil_panen');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pertanians');
    }
};
