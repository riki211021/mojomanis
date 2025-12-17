<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('profils', function (Blueprint $table) {
    $table->id();
    $table->string('judul')->nullable(); // misalnya nama desa
    $table->longText('sejarah')->nullable();
    $table->longText('visi')->nullable();
    $table->longText('misi')->nullable();
    $table->longText('struktur')->nullable(); // bisa json atau text biasa
    $table->longText('potensi')->nullable();
    $table->string('peta')->nullable(); // url embed google maps
    $table->timestamps();
});

}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profils');
    }
};
