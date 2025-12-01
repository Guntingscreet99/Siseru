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
        Schema::create('rekap_forums', function (Blueprint $table) {
            $table->id();
            $table->string('kdforum');
            $table->longText('isi_rekap');
            $table->unsignedBigInteger('dibuat_oleh')->nullable(); // admin yang bikin rekap
            $table->timestamp('dibuat_pada')->useCurrent();
            $table->timestamps();

            $table->foreign('kdforum')->references('kdforum')->on('data_forums')->onDelete('cascade');
            $table->foreign('dibuat_oleh')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rekap_forums');
    }
};
