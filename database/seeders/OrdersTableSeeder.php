<?php
// Developer: Ali Abu Taleb | Reviewed: 2025-10-18

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;

class OrdersTableSeeder extends Seeder
{
    public function run(): void
    {
        // 30 random orders by buyers
        Order::factory(30)->create();
    }
}
