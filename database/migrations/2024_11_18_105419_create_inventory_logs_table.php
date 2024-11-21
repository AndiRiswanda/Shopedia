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
        Schema::create('inventory_logs', function (Blueprint $table) {
            $table->id('log_id'); // Primary key
            $table->string('change_type'); // 'Restock' or 'Sold'
            $table->integer('quantity_chance'); // The quantity change (can be negative or positive)
            $table->timestamp('chance_date')->useCurrent(); // Timestamp for the change, defaulting to current time
            
            //FK
            $table->foreignId('product_id')->constrained(
                table: 'products', column: 'product_id', indexName: 'inventory_logs_product_id'
            )->onDelete('cascade');

            $table->timestamps(); // Created at and updated at timestamps
            });
            
        
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventory_logs');
    }
};
