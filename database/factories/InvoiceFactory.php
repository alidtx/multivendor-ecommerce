<?php
// Developer: Ali Abu Taleb | Reviewed: 2025-10-18

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class InvoiceFactory extends Factory
{
    protected $model = \App\Models\Invoice::class;

    public function definition()
    {
        $order = \App\Models\Order::inRandomOrder()->first();

        return [
            'order_id' => $order?->id ?? 1,
            'file_path' => 'invoice_' . ($order?->id ?? 1) . '.txt',
            'generated_at' => now(),
        ];
    }
}
