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
        Schema::create('businesses', function (Blueprint $table) {
            $table->id();
             $table->string('name');
            $table->string('category')->index();
            $table->string('location')->index();
            $table->decimal('rating', 3, 1)->default(0);   // e.g. 4.9
            $table->unsignedInteger('reviews')->default(0);
            $table->string('phone')->nullable();
            $table->string('website')->nullable();
            $table->string('hours')->nullable();
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->boolean('featured')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('businesses');
    }
};
