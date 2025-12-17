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
    Schema::create('artikel_photos', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('artikel_id');
        $table->string('foto'); // path foto
        $table->timestamps();

        $table->foreign('artikel_id')
              ->references('id')
              ->on('artikels')
              ->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('artikel_photos');
    }
};
