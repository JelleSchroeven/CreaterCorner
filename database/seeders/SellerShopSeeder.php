<?php

namespace database\seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Shop;
use Illuminate\Support\Str;

class SellerShopSeeder extends Seeder
{
    public function run()
    {
        $sellerData = [
            ['name' => 'Alice', 'email' => 'alice@test.com', 'shop' => 'Creative Crafts'],
            ['name' => 'Bob', 'email' => 'bob@test.com', 'shop' => 'Tech Treasures'],
            ['name' => 'Charlie', 'email' => 'charlie@test.com', 'shop' => 'Gourmet Goodies'],
            ['name' => 'Diana', 'email' => 'diana@test.com', 'shop' => 'Artistic Alley'],
            ['name' => 'Ethan', 'email' => 'ethan@test.com', 'shop' => 'Fashion Fusion'],
            ['name' => 'Fiona', 'email' => 'fiona@test.com', 'shop' => 'Home Harmony'],
        ];

        foreach ($sellerData as $data) {
            $seller = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => bcrypt('Password!321'),
                'role' => 'seller',
            ]);

            Shop::create([
                'name' => $data['shop'],
                'slug' => Str::slug($data['shop']),
                'user_id' => $seller->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
