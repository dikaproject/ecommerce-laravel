<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'John Doe',
                'email' => 'john@example.com',
                'password' => Hash::make('password123'),
                'role' => 'user',
                'phone' => '081234567891',
            ],
            [
                'name' => 'Jane Smith',
                'email' => 'jane@example.com',
                'password' => Hash::make('password123'),
                'role' => 'user',
                'phone' => '081234567892',
            ],
            [
                'name' => 'Mike Johnson',
                'email' => 'mike@example.com',
                'password' => Hash::make('password123'),
                'role' => 'user',
                'phone' => '081234567893',
            ],
            [
                'name' => 'Sarah Williams',
                'email' => 'sarah@example.com',
                'password' => Hash::make('password123'),
                'role' => 'user',
                'phone' => '081234567894',
            ],
            [
                'name' => 'David Brown',
                'email' => 'david@example.com',
                'password' => Hash::make('password123'),
                'role' => 'user',
                'phone' => '081234567895',
            ],
        ];

        foreach ($users as $userData) {
            User::create($userData);
        }
    }
}