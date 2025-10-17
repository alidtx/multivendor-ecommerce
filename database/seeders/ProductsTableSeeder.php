<?php
// Developer: Ali Abu Taleb | Reviewed: 2025-10-18
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductsTableSeeder extends Seeder
{
    public function run(): void
    {
        
        Product::factory(50)->create();
    }
}
