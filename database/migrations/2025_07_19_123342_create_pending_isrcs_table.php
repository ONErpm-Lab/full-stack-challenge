<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\PendingIsrcStatus;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pending_isrcs', function (Blueprint $table) {
            $table->id();
            $table->string('isrc')->unique();
            $table->enum('status', PendingIsrcStatus::values())
                ->default(PendingIsrcStatus::Pending)->index();
            $table->text('failure_reason')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pending_isrcs');
    }
};
