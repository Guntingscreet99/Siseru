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
        Schema::create('data_forums', function (Blueprint $table) {
            $table->id('kdforum');
            $table->string('akun')->nullable();
            $table->string('id_kelas')->nullable();
            $table->string('id_semester')->nullable();
            $table->text('topik')->nullable();
            $table->string('tahun')->nullable();
            $table->text('fileForum')->nullable();
            $table->string('judulFileAsli')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_forums');
    }
};
