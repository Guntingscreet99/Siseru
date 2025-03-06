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
        Schema::create('data_videos', function (Blueprint $table) {
            $table->id('kdvideo');
            $table->string('judul')->nullable();
            $table->string('deskripsi')->nullable();
            $table->string('link')->nullable();
            $table->text('fileVideo')->nullable();
            $table->string('judulFileAsli')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_videos');
    }
};
