<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@shopcart.com',
            'password' => Hash::make('password123'),
            'role' => 'ADMIN',
            'phone' => '+237 0700000000',
            'address' => 'Douala, Akwa'
        ]);

        User::create([
            'name' => 'Client User',
            'email' => 'client@shopcart.com',
            'password' => Hash::make('password123'),
            'role' => 'USER',
            'phone' => '+237 1700000000',
            'address' => 'Yaounde, Akwa'
        ]);
    }
}