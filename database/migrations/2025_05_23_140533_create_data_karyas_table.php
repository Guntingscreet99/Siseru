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
            $table->foreignId('id_kelas')->constrained('kelas')->onDelete('cascade');
            $table->foreignId('id_semester')->constrained('semesters')->onDelete('cascade');
            $table->string('namaMhs')->nullable();
            $table->string('nim')->nullable();
            $table->string('namaKarya')->nullable();
            $table->string('deskripsi')->nullable();
            $table->string('status')->nullable();
            // $table->integer('nilai_karya')->nullable();
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
