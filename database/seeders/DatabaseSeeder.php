<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create admin user
        User::create([
            'name' => 'Admin',
            'email' => 'admin@designart.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
            'phone' => '081234567890',
        ]);

        // Call other seeders in the correct order
        $this->call([
            UserSeeder::class,
            ServiceSeeder::class,
            PortofolioSeeder::class,
            DiscountSeeder::class,
            OrderSeeder::class,
        ]);
    }
}