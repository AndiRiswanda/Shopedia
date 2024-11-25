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
            $table->id('product_id'); // Primary key
            $table->string('product_name');
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2);
            $table->integer('stock')->default(0);
            $table->integer('sold')->default(0);
            
            //FK
            $table->foreignId('category_id')->constrained(
                table: 'categories', column: 'category_id', indexName: 'products_category_id'
            )->onDelete('cascade');

            $table->foreignId('store_id')->constrained(
                table: 'stores', column: 'store_id', indexName: 'stores_product_id'
            )->onDelete('cascade');

            $table->timestamps();
            
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
