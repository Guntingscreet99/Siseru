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
            $table->string('kdforum')->primary(); // penting!
            $table->string('akun');
            $table->unsignedBigInteger('id_kelas');
            $table->unsignedBigInteger('id_semester');
            $table->string('topik');
            $table->string('tahun');
            $table->unsignedInteger('durasi_menit')->default(60);
            $table->timestamp('waktu_selesai')->nullable();
            $table->boolean('sudah_direkap')->default(false);
            $table->string('fileForum')->nullable();
            $table->string('judulFileAsli')->nullable();

            $table->foreign('id_kelas')->references('id')->on('kelas')->onDelete('cascade');
            $table->foreign('id_semester')->references('id')->on('semesters')->onDelete('cascade');

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
