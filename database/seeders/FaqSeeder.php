<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FaqCategory;
use App\Models\Faq;

class FaqSeeder extends Seeder
{
    public function run()
    {
        $categories = [
            'Algemeen',
            'Shops & Producten',
            'Evenementen',
            'Account & Privacy',
        ];

        foreach ($categories as $catName) {
            FaqCategory::updateOrCreate(
                ['name' => $catName],
                ['created_at' => now(), 'updated_at' => now()]
            );
        }

        $faqsData = [
            'Algemeen' => [
                ['question' => 'Wat is CreaterCorner?', 'answer' => 'CreaterCorner is een platform voor creators en liefhebbers van unieke producten en evenementen.'],
                ['question' => 'Hoe kan ik contact opnemen?', 'answer' => 'Je kan ons bereiken via het contactformulier of via onze support e-mail.'],
            ],
            'Shops & Producten' => [
                ['question' => 'Hoe start ik een eigen shop?', 'answer' => 'Registreer als seller en volg de stappen om je shop aan te maken.'],
                ['question' => 'Kan ik meerdere producten toevoegen?', 'answer' => 'Ja, per shop kan je meerdere producten toevoegen.'],
            ],
            'Evenementen' => [
                ['question' => 'Hoe kan ik evenementen bekijken?', 'answer' => 'Alle evenementen zijn te vinden op de evenementenpagina van de website.'],
                ['question' => 'Kan ik me registreren voor een evenement?', 'answer' => 'Ja, via de evenementenpagina kan je je registreren voor deelname.'],
            ],
            'Account & Privacy' => [
                ['question' => 'Hoe wijzig ik mijn wachtwoord?', 'answer' => 'Ga naar je profiel en kies "wachtwoord wijzigen".'],
                ['question' => 'Worden mijn gegevens gedeeld?', 'answer' => 'Nee, je gegevens worden alleen gebruikt voor de werking van het platform.'],
            ],
        ];

        foreach ($faqsData as $catName => $faqs) {
            $category = FaqCategory::where('name', $catName)->first();
            foreach ($faqs as $faq) {
                Faq::updateOrCreate(
                    ['faq_category_id' => $category->id, 'question' => $faq['question']],
                    ['answer' => $faq['answer'], 'created_at' => now(), 'updated_at' => now()]
                );
            }
        }
    }
}
