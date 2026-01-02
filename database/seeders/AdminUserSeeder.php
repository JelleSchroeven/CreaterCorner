<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@ehb.be'],
            [
                'id' => 1,
                'name' => 'Admin',
                'password' => Hash::make('Password!321'),
                'role' => 'admin',
                'is_admin' => 1,
            ]
        );
    }
}
