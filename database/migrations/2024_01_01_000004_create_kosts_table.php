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
        Schema::create('kosts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('address');
            $table->string('city');
            $table->string('province');
            $table->string('postal_code');
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->json('photos')->nullable();
            $table->text('description')->nullable();
            $table->text('rules')->nullable();
            $table->json('facilities')->nullable();
            $table->enum('gender_type', ['putra', 'putri', 'campur'])->default('campur');
            $table->enum('kost_type', ['reguler', 'eksklusif'])->default('reguler');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            
            $table->index(['user_id', 'is_active']);
            $table->index('city');
            $table->index('gender_type');
            $table->index('kost_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kosts');
    }
};