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
        Schema::create('stores', function (Blueprint $table) {
            $table->id('store_id'); // Primary key
            $table->string('store_name');
            $table->string('profile_url'); 
            $table->string('banner_url')->nullable(); 

        
            // Foreign key to users table (Seller)
            $table->foreignId('user_id')->constrained(
                table: 'users', column: 'id', indexName: 'stores_user_id'
            )->onDelete('cascade');

            $table->text('store_desc')->nullable();
            $table->text('catch')->nullable();

            $table->timestamps();
        });
        
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stores');
    }
};
