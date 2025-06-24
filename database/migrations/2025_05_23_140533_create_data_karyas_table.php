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
        Schema::create('data_karyas', function (Blueprint $table) {
            $table->id('kdkarya');
            $table->string('nama')->nullable();
            $table->string('deskripsi')->nullable();
            $table->string('status')->nullable();
            $table->text('fileKarya')->nullable();
            $table->string('judulFileAsli')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_karyas');
    }
};
