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
        Schema::create('orders', function (Blueprint $table) {
            $table->id('order_id');
            $table->decimal('total', 12, 2);
            $table->enum('status', ['Order Placed', 'Processing', 'Shipped', 'Delivered'])->default('Processing');
            
            //fk
            $table->foreignId('user_id')->constrained(
                table: 'users', column: 'id', indexName: 'order_id'
            )->onDelete('cascade');

            $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
}; 