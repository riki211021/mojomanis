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
    Schema::table('pertanians', function (Blueprint $table) {
        $table->string('koordinat', 100)->nullable()->after('jenis_tanaman');
        $table->dropColumn('hasil_panen');
    });
}

public function down()
{
    Schema::table('pertanians', function (Blueprint $table) {
        $table->dropColumn('koordinat');
        $table->decimal('hasil_panen', 10, 2)->nullable();
    });
}

};
