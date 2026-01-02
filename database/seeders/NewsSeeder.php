<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\News;
use Carbon\Carbon;

class NewsSeeder extends Seeder
{
    public function run()
    {
        $newsItems = [
            ['Welkom bij CreaterCorner!', 'Onze website heeft nu een nieuwsfunctie! Mis niets en blijf op de hoogte van alles wat er nieuw is!', '2026-01-02'],
            ['Nieuwe shops beschikbaar', 'Er zijn verschillende nieuwe shops toegevoegd, ontdek ze en laat je inspireren!', '2026-01-03'],
            ['Evenementen kalender bijgewerkt', 'Check onze evenementenpagina voor de nieuwste festivals en meetups.', '2026-01-04'],
            ['Speciale aanbiedingen voor leden', 'Onze leden krijgen exclusieve kortingen in geselecteerde shops.', '2026-01-05'],
            ['Community tips & tricks', 'Lees de nieuwste tips van andere creators in onze community.', '2026-01-06'],
            ['Nieuwe productcategorieën toegevoegd', 'Ontdek nu nieuwe productcategorieën en vind wat je zoekt.', '2026-01-07'],
            ['Veilig online betalen', 'We hebben ons betaalsysteem verbeterd voor meer veiligheid.', '2026-01-08'],
            ['Nieuwe blogposts beschikbaar', 'Lees de nieuwste verhalen en updates van onze creators.', '2026-01-09'],
            ['Feedback van gebruikers', 'We luisteren naar onze community en passen de site aan op basis van jullie feedback.', '2026-01-10'],
            ['Uitbreiding van onze evenementen', 'Meer evenementen, meer plezier! Bekijk wat er allemaal gepland staat.', '2026-01-11'],
            ['Nieuwe samenwerking aangekondigd', 'CreaterCorner werkt samen met lokale artiesten voor unieke producten.', '2026-01-12'],
            ['Exclusieve productlanceringen', 'Ontdek de nieuwste producten die tijdelijk beschikbaar zijn in onze shops.', '2026-01-13'],
            ['Tips voor succesvolle shops', 'Lees onze handleiding voor tips om je eigen shop succesvol te maken.', '2026-01-14'],
            ['Community meetup', 'Sluit je aan bij de volgende online en offline meetups van CreaterCorner.', '2026-01-15'],
            ['Eindejaarsupdate', 'Bekijk wat we allemaal hebben bereikt en wat er volgend jaar te wachten staat!', '2026-01-16'],
        ];

        foreach ($newsItems as $item) {
            News::updateOrCreate(
                ['title' => $item[0]],
                [
                    'title' => $item[0],
                    'content' => $item[1],
                    'published_at' => Carbon::parse($item[2]),
                    'user_id' => 1, // admin
                    'image' => null, // optioneel
                ]
            );
        }
    }
}
