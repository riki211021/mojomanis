<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('agamas', function (Blueprint $table) {
            $table->id();
            $table->string('kode')->nullable(); // kode agama
            $table->string('kelompok'); // nama agama (contoh: Islam, Kristen, Katolik)
            $table->integer('jumlah')->default(0); // jumlah penduduk
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('agamas');
    }
};
