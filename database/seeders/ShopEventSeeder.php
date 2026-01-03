<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Shop;
use App\Models\Event;

class ShopEventSeeder extends Seeder
{
    public function run(): void
    {
        $shops = Shop::all();
        $events = Event::all();

        // Voor elke shop, koppel 1-3 willekeurige events
        foreach ($shops as $shop) {
            $numEvents = rand(1, $events->count());
            $randomEvents = $events->random($numEvents)->pluck('id')->toArray();

            $shop->events()->syncWithoutDetaching($randomEvents);
        }
    }
}

