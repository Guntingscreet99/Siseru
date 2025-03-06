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
        Schema::create('data_moduls', function (Blueprint $table) {
            $table->id('kdmodul');
            $table->string('judul')->nullable();
            $table->text('kelas')->nullable();
            $table->string('semester')->nullable();
            $table->string('topik')->nullable();
            $table->string('tahun')->nullable();
            $table->text('fileModul')->nullable();
            $table->string('judulFileAsli')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_moduls');
    }
};
