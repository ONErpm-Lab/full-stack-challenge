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
            $table->increments('id');
            $table->string('album_cover');
            $table->string('isrc')->unique();
            $table->dateTime('release_date');
            $table->string('title');
            $table->integer('duration');
            $table->string('preview_link')->unique();
            $table->string('spotify_link')->unique();
            $table->boolean('brasil_available');

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
