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
    Schema::table('pengajuans', function (Blueprint $table) {
        $table->text('lampiran_admin')->nullable()->after('catatan_admin');
    });
}

public function down()
{
    Schema::table('pengajuans', function (Blueprint $table) {
        $table->dropColumn('lampiran_admin');
    });
}

};
