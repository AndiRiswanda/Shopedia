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
        Schema::create('store_products', function (Blueprint $table) {

            $table->id('store_product_id');

            $table->foreignId('store_id')->constrained(
                table: 'stores', column: 'store_id', indexName: 'stores_product_store_id'
            )->onDelete('cascade');

            $table->foreignId('product_id')->nullable()->constrained(
                table: 'products', column: 'product_id', indexName: 'stores_product_product_id'
            )->onDelete('cascade'); // Foreign key to products

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('store_products');
    }
};
