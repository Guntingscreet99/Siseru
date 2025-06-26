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
        Schema::create('data_ujians', function (Blueprint $table) {
            $table->id('kdujian');
            $table->string('link')->nullable();
            $table->string('hasil')->nullable();
            $table->string('status')->nullable();
            $table->string('fileUjian')->nullable();
            $table->string('judulFileAsli')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_ujians');
    }
};
