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
        // Jika tabel sudah ada → hanya tambahkan kolom baru (jika belum ada)
        if (Schema::hasTable('data_karyas')) {
            Schema::table('data_karyas', function (Blueprint $table) {
                // Skor penilaian (skala 1-4, default 4 = nilai maksimal otomatis)
                if (!Schema::hasColumn('data_karyas', 'skor_orisinalitas')) {
                    $table->tinyInteger('skor_orisinalitas')->nullable()->default(4);
                }
                if (!Schema::hasColumn('data_karyas', 'skor_teknik')) {
                    $table->tinyInteger('skor_teknik')->nullable()->default(4);
                }
                if (!Schema::hasColumn('data_karyas', 'skor_komposisi_estetika')) {
                    $table->tinyInteger('skor_komposisi_estetika')->nullable()->default(4);
                }
                if (!Schema::hasColumn('data_karyas', 'skor_ekspresi_makna')) {
                    $table->tinyInteger('skor_ekspresi_makna')->nullable()->default(4);
                }
                if (!Schema::hasColumn('data_karyas', 'skor_kesesuaian_tema')) {
                    $table->tinyInteger('skor_kesesuaian_tema')->nullable()->default(4);
                }

                // Catatan pendukung (kalimat penjelasan dari admin)
                if (!Schema::hasColumn('data_karyas', 'catatan_orisinalitas')) {
                    $table->text('catatan_orisinalitas')->nullable();
                }
                if (!Schema::hasColumn('data_karyas', 'catatan_teknik')) {
                    $table->text('catatan_teknik')->nullable();
                }
                if (!Schema::hasColumn('data_karyas', 'catatan_komposisi_estetika')) {
                    $table->text('catatan_komposisi_estetika')->nullable();
                }
                if (!Schema::hasColumn('data_karyas', 'catatan_ekspresi_makna')) {
                    $table->text('catatan_ekspresi_makna')->nullable();
                }
                if (!Schema::hasColumn('data_karyas', 'catatan_kesesuaian_tema')) {
                    $table->text('catatan_kesesuaian_tema')->nullable();
                }

                // Total nilai
                if (!Schema::hasColumn('data_karyas', 'total_nilai')) {
                    $table->unsignedInteger('total_nilai')->nullable()->default(100);
                }
            });
        } else {
            // Jika tabel belum ada sama sekali → buat baru lengkap
            Schema::create('data_karyas', function (Blueprint $table) {
                $table->id('kdkarya');
                $table->foreignId('id_kelas')->constrained('kelas')->onDelete('cascade');
                $table->foreignId('id_semester')->constrained('semesters')->onDelete('cascade');
                $table->string('namaMhs')->nullable();
                $table->string('nim')->nullable();
                $table->string('namaKarya')->nullable();
                $table->string('deskripsi')->nullable();
                $table->text('fileKarya')->nullable();
                $table->string('judulFileAsli')->nullable();
                $table->string('status')->nullable();

                // Kolom penilaian
                $table->tinyInteger('skor_orisinalitas')->nullable()->default(4);
                $table->tinyInteger('skor_teknik')->nullable()->default(4);
                $table->tinyInteger('skor_komposisi_estetika')->nullable()->default(4);
                $table->tinyInteger('skor_ekspresi_makna')->nullable()->default(4);
                $table->tinyInteger('skor_kesesuaian_tema')->nullable()->default(4);

                // Catatan pendukung
                $table->text('catatan_orisinalitas')->nullable();
                $table->text('catatan_teknik')->nullable();
                $table->text('catatan_komposisi_estetika')->nullable();
                $table->text('catatan_ekspresi_makna')->nullable();
                $table->text('catatan_kesesuaian_tema')->nullable();

                // Total nilai
                $table->unsignedInteger('total_nilai')->nullable()->default(100);

                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('data_karyas')) {
            Schema::table('data_karyas', function (Blueprint $table) {
                $columnsToDrop = [
                    'skor_orisinalitas',
                    'skor_teknik',
                    'skor_komposisi_estetika',
                    'skor_ekspresi_makna',
                    'skor_kesesuaian_tema',
                    'catatan_orisinalitas',
                    'catatan_teknik',
                    'catatan_komposisi_estetika',
                    'catatan_ekspresi_makna',
                    'catatan_kesesuaian_tema',
                    'total_nilai'
                ];

                // Hanya drop kolom yang benar-benar ada
                foreach ($columnsToDrop as $column) {
                    if (Schema::hasColumn('data_karyas', $column)) {
                        $table->dropColumn($column);
                    }
                }
            });
        }
    }
};
