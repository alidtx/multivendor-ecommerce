<?php
// Developer: Ali Abu Taleb | Reviewed: 2025-10-18

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\Invoice;

class InvoicesTableSeeder extends Seeder
{
    public function run(): void
    {
        Order::inRandomOrder()->take(10)->get()->each(function ($order) {
            Invoice::create([
                'order_id' => $order->id,
                'file_path' => 'invoice_' . $order->id . '.txt',
                'generated_at' => now(),
            ]);
        });
    }
}
