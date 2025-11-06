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
        Schema::create('membership_payments', function (Blueprint $table) {
            $table->id();
            
            
            // Link to the user
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('membership_id')->constrained()->onDelete('cascade');
            $table->decimal('amount', 10, 2);
            $table->string('currency')->default('usd');
            $table->string('stripe_payment_intent_id')->unique();
            $table->string('stripe_charge_id')->nullable();
            $table->enum('status', ['pending', 'succeeded', 'failed', 'canceled'])->default('pending');
            $table->string('membership_type')->nullable();
            $table->string('card_last4')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('membership_payments');
    }
};
