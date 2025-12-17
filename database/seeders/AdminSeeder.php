<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::updateOrCreate(
            ['email' => 'admin@inventory.com'],
            [
                'name' => 'Admin Manager',
                'password' => \Illuminate\Support\Facades\Hash::make('password123'),
                'is_admin' => true,
            ]
        );
    }
}
