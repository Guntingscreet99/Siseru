<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('data_karyas', function (Blueprint $table) {
            // 1. Tambah kolom user_id (untuk tahu punya siapa)
            $table->foreignId('user_id')
                ->after('kdkarya')
                ->nullable()
                ->constrained('users')
                ->onDelete('cascade');

            // 2. Hapus kolom status (karena sekarang pakai ownership, bukan status manual)
            //    Admin tetap bisa lihat semua, user hanya bisa edit punya sendiri → lebih aman!
            $table->dropColumn('status');

            // 3. Pastikan namaMhs tidak boleh null (karena otomatis isi dari user)
            $table->string('namaMhs')->nullable(false)->change();

            // 4. Optional: tambah index biar cepat cari karya per user
            $table->index('user_id');
        });
    }

    public function down(): void
    {
        Schema::table('data_karyas', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
            $table->dropIndex(['user_id']);

            $table->string('status')->nullable()->after('deskripsi');

            // Kembalikan nullable jika perlu
            $table->string('namaMhs')->nullable()->change();
        });
    }
};
