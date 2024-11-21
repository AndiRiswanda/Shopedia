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
        Schema::create('wishlists', function (Blueprint $table) {
            $table->id('wishlist_id'); // Primary key

            $table->foreignId('user_id')->constrained(
                table: 'users', column: 'id', indexName: 'wishlist_user_id'
            )->onDelete('cascade'); // Foreign key to users table

            $table->foreignId('product_id')->constrained(
                table: 'products', column: 'product_id', indexName: 'wishlist_product_id'
            )->onDelete('cascade'); // Foreign key to products table

            $table->unique(['user_id', 'product_id']); // Composite unique key to prevent duplicate wishlist entries

            $table->timestamps();
        });
        
        
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wishlists');
    }
};
