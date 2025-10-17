<?php
// Developer: Ali Abu Taleb | Reviewed: 2025-10-18

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class OrderItemFactory extends Factory
{
    protected $model = \App\Models\OrderItem::class;

    public function definition()
    {
        $product = \App\Models\Product::inRandomOrder()->first();

        return [
            'order_id' => \App\Models\Order::inRandomOrder()->first()?->id ?? 1,
            'product_id' => $product?->id ?? 1,
            'seller_id' => $product?->seller_id ?? 1,
            'quantity' => $this->faker->numberBetween(1, 5),
            'price' => $product?->price ?? 10,
        ];
    }
}
