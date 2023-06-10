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
            $table->string('isrc')->unique()->nullable(false);
            $table->string('title', 30)->nullable(false);
            $table->unsignedBigInteger('album_id');
            $table->integer('duration')->nullable(false);
            $table->string('external_url')->nullable(false);
            $table->boolean('br_enabled')->nullable(false)->default(false);
            $table->string('preview_url')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
            $table->foreign('album_id')->references('id')->on('albums');
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
