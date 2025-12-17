<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('hasil_produks', function (Blueprint $table) {
            $table->id();
            $table->string('dusun');
            $table->string('rt');
            $table->year('tahun');

            $table->enum('produk', ['Padi', 'Polowijo', 'Tebu']);

            // panen per musim
            $table->integer('musim_1')->nullable();
            $table->integer('musim_2')->nullable();
            $table->integer('musim_3')->nullable();

            // total tahunan otomatis
            $table->integer('total_tahun')->nullable();

            // foto dan koordinat opsional
            $table->string('foto')->nullable();
            $table->string('koordinat')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('hasil_produks');
    }
};
