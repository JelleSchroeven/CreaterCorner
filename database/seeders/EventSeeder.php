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
                'user_id' => 1, // admin als creator
            ],
            [
                'name' => 'Manga and Cosplay Festival',
                'location' => 'Japanese Garden Brussel',
                'start_date' => '2026-09-06 00:00:00',
                'end_date' => '2026-09-07 00:00:00',
                'description' => 'Een festival waarin de wereld van manga, anime, video games en cosplay centraal staat.',
                'user_id' => 1, // admin als creator
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
