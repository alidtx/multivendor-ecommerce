<?php
// Developer: Ali Abu Taleb | Reviewed: 2025-10-18
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run(): void
    {
        // Create 1 admin user
        User::create([
            'name' => 'Admin User',
            'email' => 'alirimon5@gmail.com',
            'role' => 'admin',
            'password' => Hash::make('password'), 
            'balance' => 0,
        ]);

        User::factory(10)->state(['role' => 'seller'])->create();

        User::factory(20)->state(['role' => 'buyer'])->create();
    }
}
