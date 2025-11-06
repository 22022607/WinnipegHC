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
        Schema::create('membership_users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name', 100);
            $table->string('last_name', 100);
            $table->string('email', 150)->unique();
            $table->string('phone', 20)->nullable();
            $table->enum('membership_type', ['yearly', 'lifetime']);
            $table->text('interests')->nullable();
            $table->boolean('terms')->default(false);
            $table->timestamp('last_login_at')->nullable();
            $table->string('last_login_ip')->nullable();
            $table->timestamp('previous_login_at')->nullable();
            $table->string('previous_login_ip')->nullable();
            $table->timestamp('password_changed_at')->nullable();
            $table->timestamp('last_active_at')->nullable();
            $table->timestamp('dormant_until')->nullable();
            $table->longText('password');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('membership_users');
    }
};
