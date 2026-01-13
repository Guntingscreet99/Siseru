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
        Schema::create('rekap_nilais', function (Blueprint $table) {
            $table->id(); // ID Otomatis

            // 1. Identitas Mahasiswa
            $table->string('nama_lengkap');
            $table->string('nim');

            // 2. Relasi ke Kelas & Semester (Harus Integer)
            // Kita gunakan unsignedBigInteger agar cocok dengan id di tabel lain
            $table->unsignedBigInteger('id_kelas');
            $table->unsignedBigInteger('id_semester');

            // 3. Kolom Nilai-nilai
            // Kita gunakan 'double' agar bisa menyimpan angka desimal (koma)
            // default(0) artinya jika tidak diisi, nilainya otomatis 0
            $table->double('rekap_karya')->default(0);
            $table->double('rekap_ujian')->default(0);
            $table->double('rekap_diskusi')->default(0);

            $table->timestamps(); // Created_at & Updated_at

            // OPSIONAL: Menambahkan Foreign Key (Agar data konsisten)
            // Jika tabel kelas dan semesters sudah ada, baris ini menjaga relasi
            // $table->foreign('kelas_id')->references('id')->on('kelas')->onDelete('cascade');
            // $table->foreign('semester_id')->references('id')->on('semesters')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rekap_nilais');
    }
};
