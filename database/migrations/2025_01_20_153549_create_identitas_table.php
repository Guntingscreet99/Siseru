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
            $table->string('jenisKelamin')->nullable();
            $table->string('alamat')->nullable();
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
