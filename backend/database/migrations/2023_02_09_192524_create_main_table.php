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
        if (!Schema::hasTable('artist_track')) {
            Schema::create('artist_track', function (Blueprint $table) {
                $table->collation = 'utf8mb4_unicode_ci';
                $table->charset = 'utf8mb4';

                $table->comment('');
                $table->bigIncrements('id');
                $table->unsignedInteger('artist_id');
                $table->unsignedInteger('track_id');
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('artists')) {
            Schema::create('artists', function (Blueprint $table) {
                $table->collation = 'utf8mb4_unicode_ci';
                $table->charset = 'utf8mb4';

                $table->comment('');
                $table->bigIncrements('id');
                $table->string('spotify_id');
                $table->string('name');
                $table->timestamps();
                $table->softDeletes();
            });
        }

        if (!Schema::hasTable('failed_jobs')) {
            Schema::create('failed_jobs', function (Blueprint $table) {
                $table->collation = 'utf8mb4_unicode_ci';
                $table->charset = 'utf8mb4';

                $table->comment('');
                $table->bigIncrements('id');
                $table->string('uuid')->unique();
                $table->text('connection');
                $table->text('queue');
                $table->longText('payload');
                $table->longText('exception');
                $table->timestamp('failed_at')->useCurrent();
            });
        }

        if (!Schema::hasTable('password_resets')) {
            Schema::create('password_resets', function (Blueprint $table) {
                $table->collation = 'utf8mb4_unicode_ci';
                $table->charset = 'utf8mb4';

                $table->comment('');
                $table->string('email')->primary();
                $table->string('token');
                $table->timestamp('created_at')->nullable();
            });
        }

        if (!Schema::hasTable('personal_access_tokens')) {
            Schema::create('personal_access_tokens', function (Blueprint $table) {
                $table->collation = 'utf8mb4_unicode_ci';
                $table->charset = 'utf8mb4';

                $table->comment('');
                $table->bigIncrements('id');
                $table->string('tokenable_type');
                $table->unsignedBigInteger('tokenable_id');
                $table->string('name');
                $table->string('token', 64)->unique();
                $table->text('abilities')->nullable();
                $table->timestamp('last_used_at')->nullable();
                $table->timestamp('expires_at')->nullable();
                $table->timestamps();

                $table->index(['tokenable_type', 'tokenable_id']);
            });
        }

        if (!Schema::hasTable('tracks')) {
            Schema::create('tracks', function (Blueprint $table) {
                $table->collation = 'utf8mb4_unicode_ci';
                $table->charset = 'utf8mb4';

                $table->comment('');
                $table->bigIncrements('id');
                $table->string('isrc');
                $table->string('thumb_url');
                $table->dateTime('release_date');
                $table->string('title');
                $table->string('length');
                $table->string('spotify_url');
                $table->string('preview_url');
                $table->boolean('br_avaiable');
                $table->string('spotify_id');
                $table->timestamps();
                $table->softDeletes();
            });
        }

        if (!Schema::hasTable('users')) {
            Schema::create('users', function (Blueprint $table) {
                $table->collation = 'utf8mb4_unicode_ci';
                $table->charset = 'utf8mb4';

                $table->comment('');
                $table->bigIncrements('id');
                $table->string('name');
                $table->string('email')->unique();
                $table->timestamp('email_verified_at')->nullable();
                $table->string('password');
                $table->rememberToken();
                $table->timestamps();
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
        Schema::dropIfExists('users');

        Schema::dropIfExists('tracks');

        Schema::dropIfExists('personal_access_tokens');

        Schema::dropIfExists('password_resets');

        Schema::dropIfExists('failed_jobs');

        Schema::dropIfExists('artists');

        Schema::dropIfExists('artist_track');
    }
};
