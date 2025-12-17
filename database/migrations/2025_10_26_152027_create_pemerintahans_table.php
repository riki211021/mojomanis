<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pemerintahans', function (Blueprint $table) {
            $table->id();
            $table->text('visi')->nullable();
            $table->text('misi')->nullable();
            $table->string('struktur_foto')->nullable(); // upload gambar struktur organisasi
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pemerintahans');
    }
};
