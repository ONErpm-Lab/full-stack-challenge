<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::connection('contents')->hasTable('albums')) {
            Schema::connection('contents')->create('albums', function (Blueprint $table) {
                $table->collation = 'utf8mb4_0900_ai_ci';
                $table->charset = 'utf8mb4';

                $table->comment('');
                $table->integer('album_id', true);
                $table->string('name', 190)->nullable();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('contents')->dropIfExists('albums');
    }
};
