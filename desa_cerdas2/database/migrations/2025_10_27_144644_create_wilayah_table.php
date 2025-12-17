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
   Schema::create('wilayah', function (Blueprint $table) {
    $table->id();
    $table->string('nama');              // Nama wilayah (Dusun 1, RW 001, RT 001, dst)
    $table->string('tingkat');           // 'dusun', 'rw', 'rt'
    $table->string('ketua')->nullable();
    $table->unsignedInteger('kk')->default(0);
    $table->unsignedInteger('l')->default(0);
    $table->unsignedInteger('p')->default(0);
    $table->unsignedBigInteger('parent_id')->nullable(); // untuk hierarki
    $table->timestamps();
});

}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wilayah');
    }
};
