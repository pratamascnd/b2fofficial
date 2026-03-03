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
        Schema::create('tgallery_detail', function (Blueprint $table) {
        $table->uuid('id')->primary(); 
        
        $table->foreignUuid('gallery_id')->constrained('tgallery')->onDelete('cascade');
        
        $table->text('image');
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tgallery_detail');
    }
};
