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
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('seller_id')->constrained('users')->onDelete('cascade');
            $table->string('name');
            $table->decimal('price', 12, 2)->default(0.00);
            $table->unsignedInteger('stock_quantity')->default(0);
            $table->timestamps();
            $table->index(['seller_id']);
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
// Developer: Ali Abu Taleb | Reviewed: 2025-10-17
