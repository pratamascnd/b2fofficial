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
        Schema::create('tstreamer', function (Blueprint $table) {
            $table->id();
            $table->text('image');
            $table->string('name');
            $table->string('full_name');
            $table->text('link_instagram1')->nullable();
            $table->text('link_instagram2')->nullable();
            $table->text('link_tiktok1')->nullable();
            $table->text('link_tiktok2')->nullable();
            $table->text('link_youtube1')->nullable();
            $table->text('link_youtube2')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tstreamer');
    }
};
