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
        Schema::create('identitas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('username')->nullable(); // Tambahkan nullable jika tidak wajib
            $table->string('email')->unique()->nullable(); // Ubah menjadi nullable jika diizinkan
            $table->foreignId('id_kelas')->nullable()->constrained('kelas')->onDelete('cascade');
            $table->foreignId('id_semester')->nullable()->constrained('semesters')->onDelete('cascade');
            $table->string('tempat')->nullable();
            $table->date('tgllahir')->nullable();
            $table->string('jenisKelamin')->nullable();
            $table->string('foto_Mhs')->nullable();
            $table->string('alamat')->nullable();
            $table->string('status')->default('Aktif')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('identitas');
    }
};
