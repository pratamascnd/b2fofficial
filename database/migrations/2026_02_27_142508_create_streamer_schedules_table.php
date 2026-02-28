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
        Schema::create('tstreamer_schedule', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('streamer_id');
            $table->foreign('streamer_id')->references('id')->on('tstreamer')->onDelete('cascade');
            
            $table->date('date');         // Tanggal spesifik
            $table->time('start_time')->nullable(); // Jam mulai
            $table->string('agenda');      // Judul Game/Kegiatan
            $table->enum('status', ['streaming', 'off_day'])->default('streaming');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tstreamer_schedule');
    }
};
