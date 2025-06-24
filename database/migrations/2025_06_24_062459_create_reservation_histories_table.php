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
        Schema::create('reservation_history', function (Blueprint $table) {
            $table->id('history_id');
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('reservation_id')->constrained('reservations');
            $table->string('previous_status');
            $table->string('new_status');
            $table->timestamp('event_date')->useCurrent();
            $table->text('details')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservation_histories');
    }
};
