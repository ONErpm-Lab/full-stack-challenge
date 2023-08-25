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
        Schema::create('tracks', function (Blueprint $table) {
            $table->id();
            $table->string('album_thumb');
            $table->string('release_date');
            $table->string('track_title');
            $table->json('artists');
            $table->string('duration');
            $table->string('audio_preview_url');
            $table->string('spotify_track_url');
            $table->string('is_available_in_br');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tracks');
    }
};
