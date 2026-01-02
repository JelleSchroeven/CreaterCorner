<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class TestAccountsSeeder extends Seeder
{
    public function run(): void
    {
        // Seller account
        User::updateOrCreate(
            ['email' => 'seller@test.com'],
            [
                'name' => 'Test Seller',
                'password' => Hash::make('Password!321'),
                'role' => 'seller',
            ]
        );

        // Regular user account
        User::updateOrCreate(
            ['email' => 'user@test.com'],
            [
                'name' => 'Test User',
                'password' => Hash::make('Password!321'),
                'role' => 'user',
            ]
        );
    }
}
