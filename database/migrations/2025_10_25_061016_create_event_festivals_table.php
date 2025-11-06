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
        Schema::create('event_festivals', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->date('from_date')->nullable();
            $table->date('to_date')->nullable();
            $table->time('from_time')->nullable();
            $table->time('to_time')->nullable();
            $table->string('address')->nullable();
            $table->string('host')->nullable();
            $table->string('contact')->nullable();
            $table->string('email')->nullable();
            $table->string('facebook')->nullable();
            $table->string('website')->nullable();
            $table->decimal('admission_fee', 8, 2)->nullable();
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_festivals');
    }
};
