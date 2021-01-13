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
            /* the primary key of users table */
            $table->increments('id');
            $table->string('isrc')->unique();
            $table->dateTime('release_date');

            /* the user name of the account */
            $table->string('title');

            /* the user email; can be used in logging in */
            $table->integer('duration');

            /* stores the encrypted user password */
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
