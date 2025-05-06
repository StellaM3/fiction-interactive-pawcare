<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Story;
use App\Models\Chapter;
use App\Models\Choice;

class StorySeeder extends Seeder
{
    public function run(): void
    {
        // STORY 1: Adopter ton compagnon parfait (mise à jour)

        $story1 = Story::create([
            'title' => 'Adopter ton compagnon parfait',
        ]);
        
        // Chapitre 1
        $chapter1 = Chapter::create([
            'story_id' => $story1->id,
            'title' => 'Introduction',
            'content' => "Bienvenue dans notre refuge animalier ! Aujourd'hui est un grand jour : tu es prêt(e) à adopter un compagnon à quatre pattes. Mais avant cela, il faut bien réfléchir… Adopter un animal, c'est un engagement sur plusieurs années, qui demande amour, patience et attention au quotidien. Es-tu prêt(e) à commencer cette aventure et découvrir quel animal correspond le mieux à ton mode de vie ?",
        ]);
        
        // Chapitre 2
        $chapter2 = Chapter::create([
            'story_id' => $story1->id,
            'title' => 'Préférences d\'environnement',
            'content' => "Pour le bien-être de ton futur compagnon, ton environnement est un critère clé. Peux-tu nous dire où tu passes le plus clair de ton temps ?",
        ]);
        
        // Chapitre 3
        $chapter3 = Chapter::create([
            'story_id' => $story1->id,
            'title' => 'Activité préférée',
            'content' => "Les animaux ont des besoins variés selon leur nature. Pour t'accompagner au mieux, quel est ton style de vie au quotidien ?",
        ]);
        
        // Chapitre 4
        $chapter4 = Chapter::create([
            'story_id' => $story1->id,
            'title' => 'Temps disponible',
            'content' => "Avoir un animal demande du temps et de la présence. Combien de temps penses-tu pouvoir lui consacrer chaque jour ?",
        ]);
        
        // Chapitre 5 (Conclusion)
        $chapter5 = Chapter::create([
            'story_id' => $story1->id,
            'title' => 'Conclusion',
            'content' => "Merci d’avoir pris le temps de répondre à ces questions ! Grâce à tes réponses, nous pourrons te proposer l’animal qui correspond le mieux à ton mode de vie et à tes envies. Prépare-toi à découvrir ton futur compagnon !",
        ]);
        
        // CHOICES
        
        // Chapitre 1
        Choice::create([
            'chapter_id' => $chapter1->id,
            'content' => 'Oui, je suis prêt(e) à trouver mon compagnon idéal !',
            'next_chapter_id' => $chapter2->id,
            'score_type' => null, // pas d'influence directe ici
        ]);
        
        Choice::create([
            'chapter_id' => $chapter1->id,
            'content' => 'Non, je préfère attendre encore un peu.',
            'next_chapter_id' => null,
            'score_type' => null,
        ]);
        
        // Chapitre 2
        Choice::create([
            'chapter_id' => $chapter2->id,
            'content' => 'Principalement à l\'intérieur (appartement ou maison fermée).',
            'next_chapter_id' => $chapter3->id,
            'score_type' => 'chat',
        ]);
        
        Choice::create([
            'chapter_id' => $chapter2->id,
            'content' => 'Je profite souvent de l’extérieur (jardin, campagne…).',
            'next_chapter_id' => $chapter3->id,
            'score_type' => 'chien',
        ]);
        
        // Chapitre 3
        Choice::create([
            'chapter_id' => $chapter3->id,
            'content' => 'J\'aime rester tranquille, plutôt posé(e).',
            'next_chapter_id' => $chapter4->id,
            'score_type' => 'chat',
        ]);
        
        Choice::create([
            'chapter_id' => $chapter3->id,
            'content' => 'Je suis très actif(ve) et j\'adore bouger.',
            'next_chapter_id' => $chapter4->id,
            'score_type' => 'chien',
        ]);
        
        // Chapitre 4
        Choice::create([
            'chapter_id' => $chapter4->id,
            'content' => 'Moins d\'une heure par jour.',
            'next_chapter_id' => $chapter5->id,
            'score_type' => 'chat',
        ]);
        
        Choice::create([
            'chapter_id' => $chapter4->id,
            'content' => 'Plus de 2 heures par jour.',
            'next_chapter_id' => $chapter5->id,
            'score_type' => 'chien',
        ]);

 
    }
}
