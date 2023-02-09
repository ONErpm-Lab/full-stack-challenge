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
        if (!Schema::connection('accounts')->hasTable('users')) {
            Schema::connection('accounts')->create('users', function (Blueprint $table) {
                $table->collation = 'utf8mb3_bin';
                $table->charset = 'utf8mb3';

                $table->comment('');
                $table->integer('user_id', true);
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
        Schema::connection('accounts')->dropIfExists('users');
    }
};
