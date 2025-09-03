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
            $table->string('invoice_number')->unique();
            $table->foreignId('kost_id')->constrained()->onDelete('cascade');
            $table->foreignId('tenant_id')->constrained()->onDelete('cascade');
            $table->foreignId('room_id')->constrained()->onDelete('cascade');
            $table->enum('payment_type', ['sewa', 'deposit', 'denda', 'lainnya'])->default('sewa');
            $table->string('period_month');
            $table->integer('period_year');
            $table->date('due_date');
            $table->date('payment_date')->nullable();
            $table->decimal('amount', 12, 2);
            $table->decimal('paid_amount', 12, 2)->default(0);
            $table->enum('payment_method', ['transfer', 'cash', 'e_wallet'])->nullable();
            $table->enum('status', ['pending', 'partial', 'paid', 'overdue'])->default('pending');
            $table->text('notes')->nullable();
            $table->json('payment_proof')->nullable();
            $table->timestamps();
            
            $table->index(['kost_id', 'status']);
            $table->index(['tenant_id', 'status']);
            $table->index(['period_year', 'period_month']);
            $table->index('due_date');
            $table->index('status');
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