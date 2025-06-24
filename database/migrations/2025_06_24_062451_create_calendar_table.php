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
        Schema::create('calendars', function (Blueprint $table) {
            $table->id('calendar_id');
            $table->foreignId('cabin_id')->constrained('cabins');
            $table->date('date');
            $table->enum('status', ['available', 'booked', 'maintenance', 'blocked']);
            $table->unique(['cabin_id', 'date']);
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calendar');
    }
};
