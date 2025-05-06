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
        
        // Chapitre 5 (nouveau)
        $chapter5 = Chapter::create([
            'story_id' => $story1->id,
            'title' => 'Type d\'interaction souhaitée',
            'content' => "En adoptant un animal, tu imagines plutôt passer ton temps à…",
        ]);
        
        // CHOICES
        
        // Chapitre 1
        Choice::create([
            'chapter_id' => $chapter1->id,
            'content' => 'Oui, je suis prêt(e) à trouver mon compagnon idéal !',
            'next_chapter_id' => $chapter2->id,
            'score_type' => null,
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
        
        // Chapitre 5 (dernier)
        Choice::create([
            'chapter_id' => $chapter5->id,
            'content' => 'Avoir un compagnon indépendant qui aime son espace.',
            'next_chapter_id' => null, // Fin : ici on déclenche l’analyse pour chat/chien
            'score_type' => 'chat',
        ]);
        
        Choice::create([
            'chapter_id' => $chapter5->id,
            'content' => 'Avoir un ami fidèle qui adore être près de toi et te suivre partout.',
            'next_chapter_id' => null, // Fin
            'score_type' => 'chien',
        ]);

        
        //STORY 2 : CHAT
        $story2 = Story::create([
            'title' => 'Ton premier mois avec ton chat',
        ]);
        
        $chapter2_1 = Chapter::create([
            'story_id' => $story2->id,
            'title' => 'Découverte de ton chat',
            'content' => "Ton choix est fait : tu repars du refuge avec un adorable petit chat. Timide mais curieux, il découvre son nouvel environnement avec prudence. Il renifle les coins de la maison, saute sur le canapé… et va se cacher sous la table. C’est le début d’une belle aventure. Que fais-tu pour l’accueillir au mieux ?",
        ]);
        
        Choice::create([
            'chapter_id' => $chapter2_1->id,
            'content' => "Tu lui aménages un coin calme avec une couverture, de la nourriture et un jouet.",
            'next_chapter_id' => null,
            'impact_bonheur' => 2,
            'impact_sante' => 1,
            'impact_energie' => 1,
        ]);
        
        Choice::create([
            'chapter_id' => $chapter2_1->id,
            'content' => "Tu le laisses explorer librement sans rien préparer de particulier.",
            'next_chapter_id' => null,
            'impact_bonheur' => 0,
            'impact_sante' => 0,
            'impact_energie' => 0,
        ]);


        //STORY 3 : CHIEN
        $story3 = Story::create([
            'title' => 'Ton premier mois avec ton chien',
        ]);
        
        $chapter3_1 = Chapter::create([
            'story_id' => $story3->id,
            'title' => 'Découverte de ton chien',
            'content' => "Bienvenue à la maison ! Ton nouveau compagnon canin arrive en remuant la queue, débordant d’énergie. Il court dans tous les sens, aboie joyeusement et renverse déjà une plante. Il a besoin de repères pour se sentir en sécurité. Que fais-tu en premier ?",
        ]);
        
        Choice::create([
            'chapter_id' => $chapter3_1->id,
            'content' => "Tu le sors faire une balade calme pour l’aider à se dépenser et découvrir le quartier.",
            'next_chapter_id' => null,
            'impact_bonheur' => 1,
            'impact_sante' => 2,
            'impact_energie' => 2,
        ]);
        
        Choice::create([
            'chapter_id' => $chapter3_1->id,
            'content' => "Tu le laisses seul un moment pour qu’il s’habitue à la maison par lui-même.",
            'next_chapter_id' => null,
            'impact_bonheur' => -1,
            'impact_sante' => 0,
            'impact_energie' => 0,
        ]);
    }
}
