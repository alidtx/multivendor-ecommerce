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
        Schema::create('invoices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('order_id')->constrained('orders')->onDelete('cascade');
            $table->string('file_path');
            $table->timestamp('generated_at')->nullable();
            $table->timestamps();
            $table->unique('order_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
// Developer: Ali Abu Taleb | Reviewed: 2025-10-17
