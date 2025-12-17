<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Create Categories first if they don't exist
        $appliances = Category::firstOrCreate(['name' => 'Appliances']);
        $shoes = Category::firstOrCreate(['name' => 'Shoes']);
        $electronics = Category::firstOrCreate(['name' => 'Electronics']);

        // 2. Add the specific products from your screenshots
        $products = [
            [
                'name' => 'Deerma DX115C Household Vacuum Cleaner',
                'category_id' => $appliances->id,
                'price' => 100.44,
                'stock' => 27,
                'description' => '2-in-1 use: hand-held and vertical. Large capacity dust bin.',
            ],
            [
                'name' => 'Original Classic Era 79',
                'category_id' => $shoes->id,
                'price' => 95.99,
                'stock' => 48,
                'description' => 'Classic canvas sneakers with padded collars and signature rubber waffle outsoles.',
            ],
            [
                'name' => 'Smart LED Monitor 24"',
                'category_id' => $electronics->id,
                'price' => 149.00,
                'stock' => 15,
                'description' => 'Full HD resolution with ultra-slim bezel design.',
            ]
        ];

        foreach ($products as $productData) {
            Product::updateOrCreate(
                ['name' => $productData['name']],
                $productData
            );
        }
    }
}
