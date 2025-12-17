<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('pekerjaan', function (Blueprint $table) {
            $table->id();
            $table->string('kode')->nullable();
            $table->string('kelompok');
            $table->integer('jumlah')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('pekerjaan');
    }
};
