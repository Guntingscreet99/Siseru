<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('diskusis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');

            // PERBAIKAN PENTING: kdforum adalah STRING, bukan integer!
            $table->string('kdforum'); // Sesuai primary key di data_forums
            $table->foreign('kdforum')
                  ->references('kdforum')
                  ->on('data_forums')
                  ->onDelete('cascade');

            $table->text('pesan');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();

            // Index untuk performa (tetap bagus!)
            $table->index('kdforum');
            $table->index('user_id');
            $table->index(['kdforum', 'created_at']); // lebih optimal untuk chat
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('diskusis');
    }
};
