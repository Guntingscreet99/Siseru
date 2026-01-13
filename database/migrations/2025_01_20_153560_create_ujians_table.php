<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ujians', function (Blueprint $table) {
            $table->id('kduji');
            $table->string('ujian')->nullable();
            $table->foreignId('id_kelas')->nullable()->constrained('kelas')->onDelete('cascade');
            $table->foreignId('id_semester')->nullable()->constrained('semesters')->onDelete('cascade');
            $table->string('link')->nullable();
            $table->string('status')->nullable();
            $table->string('judulFileAsli')->nullable();
            $table->integer('durasi_menit')->nullable();
            $table->timestamp('waktu_mulai')->nullable();
            $table->timestamp('waktu_selesai')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ujians');
    }
};
