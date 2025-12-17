<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB; // <- tambahin ini

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->timestamps();
        });

        // Isi default settings
        DB::table('settings')->insert([
            ['key' => 'site_name', 'value' => 'WEBSITE RESMI DESA CERDAS', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'site_address', 'value' => 'Kec. Contoh, Kab. Contoh, Prov. Jawa Timur', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'logo', 'value' => null, 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'favicon', 'value' => null, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
