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
        Schema::create('track_artists', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('track_id');
            $table->unsignedBigInteger('artist_id');
            $table->foreign('track_id')->references('id')->on('tracks')->onDelete('cascade');
            $table->foreign('artist_id')->references('id')->on('artists')->onDelete('cascade');
            $table->unique(['track_id', 'artist_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('track_artists');
    }
};
