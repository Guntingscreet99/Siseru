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
        Schema::create('data_zooms', function (Blueprint $table) {
            $table->id('kdzoom');
            $table->string('id_kelas')->nullable();
            $table->string('linkZoom')->nullable();
            $table->string('linkWebinar')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_zooms');
    }
};
