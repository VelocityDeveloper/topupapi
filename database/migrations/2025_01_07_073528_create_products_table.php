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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('product_name');
            $table->string('category');
            $table->string('brand');
            $table->string('type');
            $table->string('seller_name');
            $table->decimal('price', 10, 2);
            $table->string('buyer_sku_code');
            $table->boolean('buyer_product_status')->default(true);
            $table->boolean('seller_product_status')->default(true);
            $table->boolean('unlimited_stock')->default(true);
            $table->integer('stock')->default(0);
            $table->boolean('multi')->default(true);
            $table->time('start_cut_off');
            $table->time('end_cut_off');
            $table->text('desc')->nullable();
            $table->boolean('status')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
