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
        $table->uuid('id')->primary(); 
        
        $table->foreignUuid('streamer_id')->constrained('tstreamer')->onDelete('cascade');
        
        $table->date('date');
        $table->time('start_time')->nullable();
        $table->string('agenda');
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
