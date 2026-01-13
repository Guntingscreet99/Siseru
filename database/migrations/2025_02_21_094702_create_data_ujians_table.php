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
        Schema::create('data_ujians', function (Blueprint $table) {
            $table->id('kdujian');
            // Rekap data
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->foreignId('kelas_id')->nullable()->constrained('kelas')->onDelete('cascade');
            $table->foreignId('semester_id')->nullable()->constrained('semesters')->onDelete('cascade');
            $table->foreignId('ujian_id')
                ->nullable()
                ->constrained('ujians', 'kduji')
                ->onDelete('cascade');

            $table->integer('score')->nullable();
            $table->date('waktu_pengerjaan')->nullable();
            $table->string('status')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_ujians');
    }
};
