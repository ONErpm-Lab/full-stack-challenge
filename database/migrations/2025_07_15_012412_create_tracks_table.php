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
            $table->string('isrc')->unique();
            $table->string('spotify_id')->unique();
            $table->string('title')->nullable();
            $table->integer('duration_ms');
            $table->string('preview_url')->nullable();
            $table->string('spotify_url')->nullable();
            $table->boolean('avaliable_in_brazil')->default(true);
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
