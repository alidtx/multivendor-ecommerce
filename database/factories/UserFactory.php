<?php
// Developer: Ali Abu Taleb | Reviewed: 2025-10-18

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UserFactory extends Factory
{
    protected $model = \App\Models\User::class;

    public function definition()
    {
        $role = $this->faker->randomElement(['buyer', 'seller']);

        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'role' => $role,
            'password' => Hash::make('password'), 
            'balance' => $role === 'seller' ? $this->faker->randomFloat(2, 0, 1000) : 0,
            'remember_token' => Str::random(10),
        ];
    }
}
