<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Jika tabel sudah ada, kita ubah saja (bukan create ulang)
        if (Schema::hasTable('data_perpustakaans')) {
            Schema::table('data_perpustakaans', function (Blueprint $table) {
                // Ubah deskripsi jadi text (bukan string)
                if (Schema::hasColumn('data_perpustakaans', 'deskripsi')) {
                    $table->text('deskripsi')->nullable()->change();
                }

                // Tambah cover kalau belum ada
                if (!Schema::hasColumn('data_perpustakaans', 'cover')) {
                    $table->string('cover')->nullable()->after('judulFileAsli');
                }

                // Tambah user_id + foreign key kalau belum ada
                if (!Schema::hasColumn('data_perpustakaans', 'user_id')) {
                    $table->unsignedBigInteger('user_id')->nullable()->after('cover');
                    $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
                }
            });
        } else {
            // Kalau tabel belum ada (jarang terjadi), buat dari awal
            Schema::create('data_perpustakaans', function (Blueprint $table) {
                $table->id('kdperpus');
                $table->string('judul')->nullable();
                $table->text('deskripsi')->nullable();                    // ← TEXT DARI AWAL
                $table->string('kategori')->nullable();
                $table->string('topik')->nullable();
                $table->string('tahun')->nullable();
                $table->string('status')->nullable();
                $table->text('filePerpus')->nullable();
                $table->string('judulFileAsli')->nullable();
                $table->string('cover')->nullable();                       // ← SUDAH ADA
                $table->unsignedBigInteger('user_id')->nullable();         // ← SUDAH ADA
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::table('data_perpustakaans', function (Blueprint $table) {
            if (Schema::hasColumn('data_perpustakaans', 'user_id')) {
                $table->dropForeign(['user_id']);
                $table->dropColumn('user_id');
            }
            if (Schema::hasColumn('data_perpustakaans', 'cover')) {
                $table->dropColumn('cover');
            }
        });
    }
};
