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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reservation_id')->constrained('reservations');
            $table->enum('payment_method', ['card', 'transfer', 'cash']);
            $table->decimal('amount', 10, 2);
            $table->string('currency', 3);
            $table->enum('payment_type', ['deposit', 'final_payment']);
            $table->enum('payment_status', ['pending', 'paid', 'failed']);
            $table->json('transaction_details')->nullable();
            $table->timestamp('payment_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
