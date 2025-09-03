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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kost_id')->constrained()->onDelete('cascade');
            $table->string('room_number');
            $table->string('floor')->default('1');
            $table->text('description')->nullable();
            $table->json('facilities')->nullable();
            $table->json('photos')->nullable();
            $table->decimal('size', 5, 2)->nullable()->comment('Ukuran kamar dalam m2');
            $table->decimal('monthly_price', 12, 2);
            $table->decimal('quarterly_price', 12, 2)->nullable();
            $table->decimal('yearly_price', 12, 2)->nullable();
            $table->enum('status', ['kosong', 'terisi', 'booking', 'maintenance'])->default('kosong');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            
            $table->unique(['kost_id', 'room_number']);
            $table->index(['kost_id', 'status']);
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};