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
        Schema::create('product_images', function (Blueprint $table) {
            $table->id('image_id'); // Primary key
            $table->string('image_url'); 
            
            //FK
            $table->foreignId('product_id')->constrained(
                table: 'products', column: 'product_id', indexName: 'product_images_product_id'
                )->onDelete('cascade');
                
                $table->timestamps();
            
        });
        
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_images');
    }
};
