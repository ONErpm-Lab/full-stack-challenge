<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSongsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('songs', function (Blueprint $table) {
        $table->id();
        $table->timestamps();

        $table->string('isrc');
        $table->unique('isrc');
        $table->index('isrc');

        // For the artists field, we'd probably use a separate "Artists" table
        // with a one to many relationship with the "Songs" table but I'm keeping
        // things simple and I'll just store a string with artist names separated
        // by commas.
        $table->string('artists');

        $table->string('thumb');
        $table->date('release_date');
        $table->string('title');
        $table->integer('duration');
        $table->string('audio_preview');
        $table->string('spotify_link');
        $table->boolean('available_in_br');

        $table->index('title');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('songs');
    }
}
