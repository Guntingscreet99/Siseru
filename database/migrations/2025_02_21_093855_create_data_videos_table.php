<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Cek apakah tabel sudah ada (misal dari migrasi lama)
        if (Schema::hasTable('data_videos')) {
            // Tabel sudah ada → kita hanya tambah kolom user_id + foreign key kalau belum ada
            Schema::table('data_videos', function (Blueprint $table) {
                // Ubah fileVideo jadi text (lebih aman untuk path panjang)
                if (Schema::hasColumn('data_videos', 'fileVideo')) {
                    $table->text('fileVideo')->nullable()->change();
                }

                // Ubah deskripsi jadi text kalau masih varchar
                if (Schema::hasColumn('data_videos', 'deskripsi')) {
                    $table->text('deskripsi')->nullable()->change();
                }

                // Tambahkan kolom user_id + foreign key kalau belum ada
                if (!Schema::hasColumn('data_videos', 'user_id')) {
                    $table->foreignId('user_id')
                          ->nullable()
                          ->after('kdvideo')  // atau after('judulFileAsli') terserah kamu
                          ->constrained('users')
                          ->onDelete('cascade');
                }
            });
        } else {
            // Tabel belum ada → buat dari awal (ideal & rapi)
            Schema::create('data_videos', function (Blueprint $table) {
                $table->id('kdvideo');                           // primary key custom
                $table->string('judul');
                $table->text('deskripsi')->nullable();
                $table->string('link')->nullable();
                $table->text('fileVideo')->nullable();           // text lebih aman daripada string
                $table->string('judulFileAsli')->nullable();

                // Kolom user_id + foreign key langsung dari awal
                $table->foreignId('user_id')
                      ->nullable()
                      ->constrained('users')
                      ->onDelete('cascade');

                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        // Hapus foreign key dulu baru kolom (urutan penting!)
        Schema::table('data_videos', function (Blueprint $table) {
            if (Schema::hasColumn('data_videos', 'user_id')) {
                // Laravel 9+ otomatis nama foreign key: data_videos_user_id_foreign
                $table->dropForeign(['user_id']);
                $table->dropColumn('user_id');
            }
        });

        // Jika ingin hapus seluruh tabel (jarang dipakai)
        // Schema::dropIfExists('data_videos');
    }
};
