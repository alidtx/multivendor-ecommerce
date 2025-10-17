<?php
// Developer: Ali Abu Taleb | Reviewed: 2025-10-17
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('order_id')->constrained('orders')->onDelete('cascade');
            $table->foreignId('product_id')->constrained('products')->onDelete('restrict');
            $table->foreignId('seller_id')->constrained('users')->onDelete('cascade');
            $table->unsignedInteger('quantity');
            $table->decimal('price', 12, 2); 
            $table->timestamps();

            $table->index(['order_id', 'seller_id']);
            $table->index(['product_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
// Developer: Ali Abu Taleb | Reviewed: 2025-10-17
