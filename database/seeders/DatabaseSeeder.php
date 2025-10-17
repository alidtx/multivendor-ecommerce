<?php
// Developer: Ali Abu Taleb | Reviewed: 2025-10-18
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
   public function run(): void
    {
        $this->call([
            UsersTableSeeder::class,
            ProductsTableSeeder::class,
            OrdersTableSeeder::class,
            OrderItemsTableSeeder::class,
            InvoicesTableSeeder::class,
        ]);
    }
}
