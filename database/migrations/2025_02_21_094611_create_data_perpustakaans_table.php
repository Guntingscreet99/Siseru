<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('data_perpustakaans', function (Blueprint $table) {
            $table->id();
            $table->string('judulbuku');
            $table->string('kategoribuku');
            $table->string('judulmodul');
            $table->string('kategorimodul');
            $table->string('judulartikel');
            $table->string('kategoriartikel');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_perpustakaans');
    }
};
