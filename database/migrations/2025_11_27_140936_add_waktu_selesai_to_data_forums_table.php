<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('rekap_forum', function (Blueprint $table) {
            $table->id();
            $table->string('kdforum'); // foreign ke data_forums.kdforum
            $table->longText('isi_rekap');
            $table->unsignedBigInteger('user_id')->nullable(); // null = otomatis
            $table->timestamp('tanggal_rekap')->useCurrent();
            $table->timestamps();

            $table->foreign('kdforum')->references('kdforum')->on('data_forums')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('data_forums', function (Blueprint $table) {
            $table->dropColumn(['waktu_selesai', 'sudah_direkap']);
        });
    }
};
