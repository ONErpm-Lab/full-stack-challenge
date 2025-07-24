<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('artist_track', function (Blueprint $table) {
            $table->id();
            $table->foreignId('track_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('artist_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->unique(['track_id', 'artist_id']);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('artist_track');
    }
};
