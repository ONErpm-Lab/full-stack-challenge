<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('tracks', function (Blueprint $table) {
            $table->id();
            $table->string('isrc')->unique();
            $table->string('name');
            $table->string('thumb_url');
            $table->integer('duration_ms');
            $table->string('spotify_id');
            $table->string('spotify_url');
            $table->string('preview_url')->nullable();
            $table->boolean('available_in_br');
            $table->foreignId('album_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tracks');
    }
};
