<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Event;

class EventSeeder extends Seeder
{
    public function run(): void
    {
        $events = [
            [
                'name' => 'Comi con Brussel',
                'location' => 'Tour & Taxis',
                'start_date' => '2026-05-02 00:00:00',
                'end_date' => '2026-05-03 00:00:00',
                'description' => 'Comicon',
                'user_id' => 1, 
            ],
            [
                'name' => 'Manga and Cosplay Festival',
                'location' => 'Japanese Garden Brussel',
                'start_date' => '2026-09-06 00:00:00',
                'end_date' => '2026-09-07 00:00:00',
                'description' => 'Een festival waarin de wereld van manga, anime, video games en cosplay centraal staat.',
                'user_id' => 1,
            ],
            [
                'name' => 'Cosplay Mania',
                'location' => 'Antwerp Expo',
                'start_date' => '2026-07-18 00:00:00',
                'end_date' => '2026-07-19 00:00:00',
                'description' => 'Cosplay Mania is een evenement voor alle liefhebbers van cosplay, manga en popcultuur.',
                'user_id' => 1,
            ],
            [
                'name' => 'Anime & Cosplay Weekend',
                'location' => 'Ghent Convention Center',
                'start_date' => '2026-11-14 00:00:00',
                'end_date' => '2026-11-15 00:00:00',
                'description' => 'Een weekend vol anime, cosplay en workshops voor fans van alle leeftijden.',
                'user_id' => 1,
            ],
        ];

        foreach ($events as $event) {
            Event::updateOrCreate(
                ['name' => $event['name']],
                $event
            );
        }
    }
}
