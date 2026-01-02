<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Shop;
use App\Models\Product;
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

        // Vaste producten per shop
        $productsPerShop = [
            'Alice' => [
                ['name' => 'Handgemaakte ketting', 'description' => 'Prachtige handgemaakte ketting', 'price' => 25, 'stock' => 10],
                ['name' => 'Schilderij', 'description' => 'Abstract schilderij op canvas', 'price' => 50, 'stock' => 5],
            ],
            'Bob' => [
                ['name' => 'Laptopstandaard', 'description' => 'Ergonomische laptopstandaard', 'price' => 35, 'stock' => 8],
                ['name' => 'USB Hub', 'description' => '4-poorts USB Hub', 'price' => 15, 'stock' => 20],
            ],
            'Charlie' => [
                ['name' => 'Chocolade truffels', 'description' => 'Heerlijke handgemaakte truffels', 'price' => 12, 'stock' => 50],
                ['name' => 'Ambachtelijke kaas', 'description' => 'Lokale ambachtelijke kaas', 'price' => 20, 'stock' => 15],
                ['name' => 'Gourmet koekjes', 'description' => 'Verse gourmet koekjes', 'price' => 10, 'stock' => 30],
            ],
            'Diana' => [
                ['name' => 'Aquarel schilderij', 'description' => 'Klein aquarel schilderij', 'price' => 40, 'stock' => 7],
                ['name' => 'Potloodset', 'description' => 'Set van 12 potloden', 'price' => 8, 'stock' => 25],
            ],
            'Ethan' => [
                ['name' => 'Designer shirt', 'description' => 'Stijlvol designer shirt', 'price' => 45, 'stock' => 12],
                ['name' => 'Sjaal', 'description' => 'Warme wollen sjaal', 'price' => 20, 'stock' => 15],
            ],
            'Fiona' => [
                ['name' => 'Kussenset', 'description' => 'Set van 2 kussens', 'price' => 30, 'stock' => 10],
                ['name' => 'Kaarsenhouder', 'description' => 'Decoratieve kaarsenhouder', 'price' => 18, 'stock' => 20],
            ],
        ];

        foreach ($sellerData as $data) {
            $seller = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => bcrypt('Password!321'),
                'role' => 'seller',
            ]);

            $shop = Shop::create([
                'name' => $data['shop'],
                'slug' => Str::slug($data['shop']),
                'user_id' => $seller->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // producten toevoegen
            if (isset($productsPerShop[$data['name']])) {
                foreach ($productsPerShop[$data['name']] as $prod) {
                    Product::create([
                        'name' => $prod['name'],
                        'description' => $prod['description'],
                        'price' => $prod['price'],
                        'stock' => $prod['stock'],
                        'image_path' => null,
                        'user_id' => $seller->id,
                        'shop_id' => $shop->id,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }
    }
}