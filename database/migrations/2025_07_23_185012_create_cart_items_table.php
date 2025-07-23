<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cart_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->integer('quantity');
            $table->timestamps();
            
            // Unique constraint to prevent duplicate items for same user-product combination
            $table->unique(['user_id', 'product_id']);
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('cart_items');
    }
};