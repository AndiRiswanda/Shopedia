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
        Schema::create('order_details', function (Blueprint $table) {
            $table->id('order_detail_id');
            $table->integer('quantity');
            $table->enum('status', ['Order Placed', 'Processing', 'Shipped', 'Delivered'])->default('Processing');

            //fk
            $table->foreignId('order_id')->constrained(
                table: 'orders', column: 'order_id', indexName: 'order_detail_order_id'
            )->onDelete('cascade');
            
            $table->foreignId('product_id')->constrained(
                table: 'products', column: 'product_id', indexName: 'order_details_product_id'
            )->onDelete('cascade');

            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_details');
    }
};
