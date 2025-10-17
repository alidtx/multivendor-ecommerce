<?php
// Developer: Ali Abu Taleb | Reviewed: 2025-10-18

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    protected $model = \App\Models\Order::class;

    public function definition()
    {
        return [
            'buyer_id' => \App\Models\User::where('role', 'buyer')->inRandomOrder()->first()?->id ?? 1,
            'order_number' => 'ORD-' . strtoupper($this->faker->unique()->bothify('####??')),
            'total_amount' => 0, 
            'status' => $this->faker->randomElement(['pending', 'paid', 'cancelled', 'shipped']),
            'invoiced' => $this->faker->boolean(30),
        ];
    }
}
