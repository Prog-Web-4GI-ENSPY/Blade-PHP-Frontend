<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'azaleodel',
            'email' => 'admin@shopecart.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);

        // Optionnel : Créer aussi un vendeur de test
        User::create([
            'name' => 'Vendeur Test',
            'email' => 'vendor@shopecart.com',
            'password' => Hash::make('vendor123'),
            'role' => 'vendor',
            'email_verified_at' => now(),
        ]);

        // Optionnel : Créer un client de test
        User::create([
            'name' => 'Client Test',
            'email' => 'client@shopecart.com',
            'password' => Hash::make('client123'),
            'role' => 'client',
            'email_verified_at' => now(),
        ]);

        $this->command->info('Utilisateurs de test créés avec succès !');
        $this->command->info('Admin: admin@shopecart.com / admin123');
        $this->command->info('Vendor: vendor@shopecart.com / vendor123');
        $this->command->info('Client: client@shopecart.com / client123');
    }
}