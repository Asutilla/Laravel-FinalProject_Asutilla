<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;


    public function run(): void
    {
        \App\Models\User::create([
            'name' => 'Admin Manager',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password123'),
            'is_admin' => true,
        ]);

        $shoes = \App\Models\Category::create(['name' => 'Shoes']);
        $appliances = \App\Models\Category::create(['name' => 'Appliances']);

        \App\Models\Product::create([
            'name' => 'Nike Air Force 1',
            'category_id' => $shoes->id,
            'price' => 120.00,
            'stock' => 123,
        ]);
    }
}
