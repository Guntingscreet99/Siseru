<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('data_perpustakaans', function (Blueprint $table) {
            // Tambah kolom cover kalau belum ada
            if (!Schema::hasColumn('data_perpustakaans', 'cover')) {
                $table->string('cover')->nullable()->after('judulFileAsli');
            }

            // Tambah kolom user_id + foreign key kalau belum ada
            if (!Schema::hasColumn('data_perpustakaans', 'user_id')) {
                $table->unsignedBigInteger('user_id')->nullable()->after('cover');
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            }
        });
    }

    public function down(): void
    {
        Schema::table('data_perpustakaans', function (Blueprint $table) {
            if (Schema::hasColumn('data_perpustakaans', 'user_id')) {
                $table->dropForeign(['user_id']);   // <-- PAKAI ARRAY DI SINI!
                $table->dropColumn('user_id');
            }

            if (Schema::hasColumn('data_perpustakaans', 'cover')) {
                $table->dropColumn('cover');
            }
        });
    }
};
