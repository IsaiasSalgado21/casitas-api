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
        Schema::create('review_alerts', function (Blueprint $table) {
            $table->id('alert_id');
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('reservation_id')->constrained('reservations');
            $table->enum('event_type', ['on_completion', 'post_use']);
            $table->timestamp('alert_date')->useCurrent();
            $table->boolean('sent')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('review_alerts');
    }
};
