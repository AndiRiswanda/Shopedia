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
        Schema::create('cart_details', function (Blueprint $table) {
            $table->id('cart_detail_id'); // Primary key
            $table->integer('quantity'); 
            
            //FK
            $table->foreignId('cart_id')->constrained(
                table: 'carts', column: 'cart_id', indexName: 'cart_details_cart_id'
            )->onDelete('cascade'); // Foreign key to carts
            
            $table->foreignId('product_id')->constrained(
                table: 'products', column: 'product_id', indexName: 'cart_details_product_id'
            )->onDelete('cascade'); // Foreign key to products
            
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart_details');
    }
};
