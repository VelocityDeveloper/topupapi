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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('domain')->unique();
            $table->string('email')->unique();
            $table->string('name');
            $table->string('telepon')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });


        Schema::create('customer_licenses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('customers')->onDelete('cascade');
            $table->string('secret_code', 20)->unique();
            $table->string('secret_key')->uuid();
            $table->string('active')->boolean([true, false]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
