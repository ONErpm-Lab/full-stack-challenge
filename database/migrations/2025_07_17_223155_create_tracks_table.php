<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('tracks', function (Blueprint $table) {
            $table->id();
            $table->string('isrc')->unique();
            $table->string('title');
            $table->string('album_thumb');
            $table->string('release_date');
            $table->string('artists');
            $table->string('duration');
            $table->string('preview_url')->nullable();
            $table->string('spotify_url');
            $table->boolean('available_in_br')->default(false);
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
