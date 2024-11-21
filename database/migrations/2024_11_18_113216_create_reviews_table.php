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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id('review_id'); // Primary key
            $table->integer('rating')->unsigned(); // Rating field (1-5)
            $table->text('comment')->nullable(); // Comment field (optional)

            //FK
            $table->foreignId('product_id')->constrained(
                table: 'products', column: 'product_id', indexName: 'reviews_product_id'
            )->onDelete('cascade'); // Foreign to Product

            $table->foreignId('user_id')->constrained(
                table: 'users', column: 'id', indexName: 'reviews_user_id'
            )->onDelete('cascade'); // Foreign key to users 
            

            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
