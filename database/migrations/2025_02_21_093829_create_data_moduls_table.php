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
        // Cek apakah tabel sudah ada (misal dari migrasi lama)
        if (Schema::hasTable('data_moduls')) {
            // Tabel sudah ada → kita hanya tambah kolom user_id + foreign key kalau belum ada
            Schema::table('data_moduls', function (Blueprint $table) {
                // Ubah fileModul jadi text (lebih aman untuk path panjang)
                if (Schema::hasColumn('data_moduls', 'fileModul')) {
                    $table->text('fileModul')->nullable()->change();
                }

                // Ubah deskripsi jadi text kalau masih varchar
                if (Schema::hasColumn('data_moduls', 'deskripsi')) {
                    $table->text('deskripsi')->nullable()->change();
                }

                // Tambahkan kolom user_id + foreign key kalau belum ada
                if (!Schema::hasColumn('data_moduls', 'user_id')) {
                    $table->foreignId('user_id')
                        ->nullable()
                        ->after('kdmodul')  // atau after('judulFileAsli') terserah kamu
                        ->constrained('users')
                        ->onDelete('cascade');
                }
            });
        } else {
            Schema::create('data_moduls', function (Blueprint $table) {
                $table->id('kdmodul');
                $table->string('judul')->nullable();
                $table->foreignId('id_kelas')->constrained('kelas')->onDelete('cascade');
                $table->foreignId('id_semester')->constrained('semesters')->onDelete('cascade');
                $table->string('topik')->nullable();
                $table->string('tahun')->nullable();
                $table->text('fileModul')->nullable();
                $table->string('judulFileAsli')->nullable();
                $table->string('status')->nullable();

                $table->foreignId('user_id')
                    ->nullable()
                    ->constrained('users')
                    ->onDelete('cascade');

                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Hapus foreign key dulu baru kolom (urutan penting!)
        Schema::table('data_moduls', function (Blueprint $table) {
            if (Schema::hasColumn('data_videos', 'user_id')) {
                // Laravel 9+ otomatis nama foreign key: data_videos_user_id_foreign
                $table->dropForeign(['user_id']);
                $table->dropColumn('user_id');
                $table->dropIndex(['user_id']);
            }
        });
    }
};
