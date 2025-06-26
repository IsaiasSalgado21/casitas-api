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
            $table->string('payment_method', 50);
            $table->decimal('amount', 10, 2);
            $table->string('currency', 3);
            $table->string('payment_type', 50);
            $table->string('payment_status', 50);
            $table->string('transaction_details')->nullable();
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
