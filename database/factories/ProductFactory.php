<?php
// Developer: Ali Abu Taleb | Reviewed: 2025-10-18

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = \App\Models\Product::class;

    public function definition()
    {
        return [
            'seller_id' => \App\Models\User::where('role', 'seller')->inRandomOrder()->first()?->id ?? 1,
            'name' => $this->faker->words(3, true),
            'price' => $this->faker->randomFloat(2, 10, 500),
            'stock_quantity' => $this->faker->numberBetween(5, 100),
        ];
    }
}
