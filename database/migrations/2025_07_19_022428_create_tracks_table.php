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
            $table->string('name');
            $table->string('release_date');
            $table->string('release_date_precision')->nullable();
            $table->bigInteger('duration_ms');
            $table->string('external_url');
            $table->string('preview_url')->nullable();
            $table->boolean('is_playable');
            $table->string('isrc')->index();
            $table->string('music_platform_id');
            $table->string('music_platform');
            $table->timestamps();
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
