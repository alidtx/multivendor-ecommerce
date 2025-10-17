<?php
// Developer: Ali Abu Taleb | Reviewed: 2025-10-18

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;

class OrderItemsTableSeeder extends Seeder
{
    public function run(): void
    {
        // Loop through each order and attach 1-3 random products
        Order::all()->each(function ($order) {
            $products = Product::inRandomOrder()->take(rand(1, 3))->get();
            $total = 0;

            foreach ($products as $product) {
                $quantity = rand(1, 5);

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'seller_id' => $product->seller_id,
                    'quantity' => $quantity,
                    'price' => $product->price,
                ]);
            }

            $order->update(['total_amount' => $total]);
        });
    }
}
