<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InitialDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Create Categories
        $shoes = \App\Models\Category::create(['name' => 'Shoes']);
        $appliances = \App\Models\Category::create(['name' => 'Appliances']);
        $electronics = \App\Models\Category::create(['name' => 'Electronics']);

        // 2. Create Products for Shoes
        \App\Models\Product::create([
            'name' => 'Nike Air Force 1',
            'category_id' => $shoes->id,
            'price' => 120.00,
            'stock' => 123,
            'description' => 'Classic white sneakers.'
        ]);

        // 3. Create a Low Stock Item (to test your alerts)
        \App\Models\Product::create([
            'name' => 'Gaming Mouse',
            'category_id' => $electronics->id,
            'price' => 50.00,
            'stock' => 2,
            'description' => 'High-precision gaming mouse.'
        ]);
    }
}
