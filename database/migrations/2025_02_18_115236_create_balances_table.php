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
        Schema::create('balances', function (Blueprint $table) {
            $table->id();
            $table->enum('flow', ['in', 'out'])->default('in');
            $table->foreignId('customer_id')->constrained('customers')->onDelete('cascade');
            $table->decimal('nominal', 10, 2);
            $table->foreignId('transaction_id')->constrained('transactions')->onDelete('cascade')->nullable();
            $table->string('description')->nullable();
            $table->timestamp('date');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('balances');
    }
};
