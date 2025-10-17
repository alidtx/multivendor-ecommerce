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
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('buyer_id')->constrained('users')->onDelete('cascade');
            $table->string('order_number')->unique();
            $table->decimal('total_amount', 14, 2)->default(0.00);
            $table->enum('status', ['pending', 'paid', 'cancelled', 'shipped'])->default('pending');
            $table->boolean('invoiced')->default(false)->comment('Indicates if invoice has been generated');
            $table->timestamps();

            $table->index(['buyer_id', 'status']);
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
// Developer: Ali Abu Taleb | Reviewed: 2025-10-17
