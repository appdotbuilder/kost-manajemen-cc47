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
        Schema::create('tenants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kost_id')->constrained()->onDelete('cascade');
            $table->foreignId('room_id')->nullable()->constrained()->onDelete('set null');
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('phone');
            $table->text('address')->nullable();
            $table->string('id_number')->nullable()->comment('Nomor KTP');
            $table->string('emergency_contact_name')->nullable();
            $table->string('emergency_contact_phone')->nullable();
            $table->string('profession')->nullable();
            $table->json('documents')->nullable()->comment('KTP, KK, Kontrak files');
            $table->date('check_in_date')->nullable();
            $table->date('check_out_date')->nullable();
            $table->enum('status', ['aktif', 'keluar', 'suspend'])->default('aktif');
            $table->text('notes')->nullable();
            $table->timestamps();
            
            $table->index(['kost_id', 'status']);
            $table->index('phone');
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tenants');
    }
};