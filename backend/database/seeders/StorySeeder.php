<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Story;
use App\Models\Chapter;
use App\Models\Choice;
use App\Enums\ScoreType;

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

        // --- Chapitre 6 (nouveau) ---
$chapter6 = Chapter::create([
    'story_id' => $story1->id,
    'title'    => 'Vie nocturne',
    'content'  => "La nuit, tu préfères être réveillé(e) par…",
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
            'score_type' => ScoreType::CHAT,
        ]);
        
        Choice::create([
            'chapter_id' => $chapter2->id,
            'content' => 'Je profite souvent de l’extérieur (jardin, campagne…).',
            'next_chapter_id' => $chapter3->id,
            'score_type' => ScoreType::CHIEN,
        ]);
        
        // Chapitre 3
        Choice::create([
            'chapter_id' => $chapter3->id,
            'content' => 'J\'aime rester tranquille, plutôt posé(e).',
            'next_chapter_id' => $chapter4->id,
            'score_type' => ScoreType::CHAT,
        ]);
        
        Choice::create([
            'chapter_id' => $chapter3->id,
            'content' => 'Je suis très actif(ve) et j\'adore bouger.',
            'next_chapter_id' => $chapter4->id,
            'score_type' => ScoreType::CHIEN,
        ]);
        
        // Chapitre 4
        Choice::create([
            'chapter_id' => $chapter4->id,
            'content' => 'Moins d\'une heure par jour.',
            'next_chapter_id' => $chapter5->id,
            'score_type' => ScoreType::CHAT,
        ]);
        
        Choice::create([
            'chapter_id' => $chapter4->id,
            'content' => 'Plus de 2 heures par jour.',
            'next_chapter_id' => $chapter5->id,
            'score_type' => ScoreType::CHIEN,
        ]);
        
        // Chapitre 5 (dernier)
        Choice::create([
            'chapter_id'     => $chapter5->id,          // ⚠️ on corrige les fins du chap. 5
            'content'        => 'Avoir un compagnon indépendant qui aime son espace.',
            'next_chapter_id'=> $chapter6->id,          // ▶️ enchaîne sur chap. 6
            'score_type' => ScoreType::CHAT,
        ]);
        
        Choice::create([
            'chapter_id'     => $chapter5->id,
            'content'        => 'Avoir un ami fidèle qui te suit partout.',
            'next_chapter_id'=> $chapter6->id,
            'score_type' => ScoreType::CHIEN,
        ]);

        // Choix du nouveau chapitre 6
Choice::create([
    'chapter_id'      => $chapter6->id,
    'content'         => "Un doux ronronnement près de tes pieds.",
    'next_chapter_id' => null,
    'score_type' => ScoreType::CHAT,
]);

Choice::create([
    'chapter_id'      => $chapter6->id,
    'content'         => "Des petits pas pressés qui réclament une balade.",
    'next_chapter_id' => null,
    'score_type' => ScoreType::CHIEN,
]);
        
        // STORY 2 : CHAT
$story2 = Story::create([
    'title' => 'Ton premier mois avec ton chat',
]);

// 🐾 CHAPITRES (TOUS d'abord)
$chapter2_1 = Chapter::create([
    'story_id' => $story2->id,
    'title' => 'Découverte de ton chat',
    'content' => "Ton choix est fait : tu repars du refuge avec un adorable petit chat. Timide mais curieux, il découvre son nouvel environnement avec prudence. Il renifle les coins de la maison, saute sur le canapé… et va se cacher sous la table. C’est le début d’une belle aventure. Que fais-tu pour l’accueillir au mieux ?",
]);

$chapter2_2 = Chapter::create([
    'story_id' => $story2->id,
    'title' => 'L’alimentation idéale',
    'content' => "Ton chaton, curieux mais encore méfiant, s’approche doucement de ses gamelles. Il renifle, fait un petit miaou hésitant. Tu te souviens des conseils entendus au refuge, mais en regardant son petit visage attendrissant, le doute s’installe. Tu as du lait dans le frigo, mais aussi de l’eau fraîche prête. Quel choix fais-tu pour bien débuter son alimentation ?",
]);

$chapter2_3 = Chapter::create([
    'story_id' => $story2->id,
    'title' => 'Premières bêtises',
    'content' => "Une journée bien remplie se termine. Tu rentres chez toi fatigué(e), mais un détail attire ton regard : le canapé… il est en lambeaux ! Ton chat est recroquevillé dans un coin, l’air coupable. Tu hésites entre la colère et la compréhension. Comment réagis-tu face à cette première grosse bêtise ?",
]);

$chapter2_4 = Chapter::create([
    'story_id' => $story2->id,
    'title' => 'La visite chez le vétérinaire',
    'content' => "Les jours passent et ton chat prend confiance. Mais une question reste en suspens : sa santé. Tu sais qu’une première visite vétérinaire est recommandée, même si ton compagnon semble en pleine forme. Le stress monte à l’idée de le mettre dans une caisse de transport… Quelle décision prends-tu ?",
]);

$chapter2_5 = Chapter::create([
    'story_id' => $story2->id,
    'title' => 'Rencontre inattendue',
    'content' => "Un samedi après-midi, un ami passe te voir… accompagné de son chien ! Ton chat, surpris, se hérisse et file sous la table, les yeux grands ouverts. La tension est palpable. Comment réagis-tu face à cette rencontre inattendue ?",
]);

$chapter2_6 = Chapter::create([
    'story_id' => $story2->id,
    'title' => 'Jouer ou se reposer ?',
    'content' => "Ton chat tourne autour de toi, l’air espiègle. Il bondit, s’accroche à ta manche… pas de doute : il veut jouer ! Mais toi, tu es affalé(e) sur le canapé après une longue journée. Que fais-tu pour ton petit compagnon ?",
]);

$chapter2_7 = Chapter::create([
    'story_id' => $story2->id,
    'title' => 'Bilan du premier mois',
    'content' => "Un mois s’est écoulé depuis l’adoption. Ton chat te regarde avec ses grands yeux brillants. Il est à la fois plus confiant, plus proche de toi… ou peut-être un peu distant selon vos aventures. Tu repenses à chaque choix que tu as fait et ressens la fierté d’avoir changé la vie de ce petit être.",
]);

// ✅ CHOICES (ensuite seulement !)

// Chapitre 1
Choice::create([
    'chapter_id' => $chapter2_1->id,
    'content' => "Tu lui aménages un coin calme avec une couverture, de la nourriture et un jouet.",
    'next_chapter_id' => $chapter2_2->id,
    'impact_bonheur' => 2,
    'impact_sante' => 1,
    'impact_energie' => 1,
]);

Choice::create([
    'chapter_id' => $chapter2_1->id,
    'content' => "Tu le laisses explorer librement sans rien préparer de particulier.",
    'next_chapter_id' => $chapter2_2->id,
    'impact_bonheur' => 0,
    'impact_sante' => 0,
    'impact_energie' => 0,
]);

// Chapitre 2
Choice::create([
    'chapter_id' => $chapter2_2->id,
    'content' => "Je lui mets de l’eau fraîche comme recommandé par le vétérinaire.",
    'next_chapter_id' => $chapter2_3->id,
    'impact_bonheur' => 2,
    'impact_sante' => 2,
    'impact_energie' => 0,
]);

Choice::create([
    'chapter_id' => $chapter2_2->id,
    'content' => "Je lui donne un peu de lait car il adore ça.",
    'next_chapter_id' => $chapter2_3->id,
    'impact_bonheur' => 1,
    'impact_sante' => -2,
    'impact_energie' => 0,
]);

// Chapitre 3
Choice::create([
    'chapter_id' => $chapter2_3->id,
    'content' => "Je le gronde fermement et le mets dehors quelques minutes.",
    'next_chapter_id' => $chapter2_4->id,
    'impact_bonheur' => -2,
    'impact_sante' => 0,
    'impact_energie' => -1,
]);

Choice::create([
    'chapter_id' => $chapter2_3->id,
    'content' => "Je lui propose un griffoir et ignore la bêtise : il doit apprendre.",
    'next_chapter_id' => $chapter2_4->id,
    'impact_bonheur' => 2,
    'impact_sante' => 0,
    'impact_energie' => 1,
]);

// Chapitre 4
Choice::create([
    'chapter_id' => $chapter2_4->id,
    'content' => "J’y vais dès la première semaine pour un check-up complet.",
    'next_chapter_id' => $chapter2_5->id,
    'impact_bonheur' => -1,
    'impact_sante' => 3,
    'impact_energie' => 0,
]);

Choice::create([
    'chapter_id' => $chapter2_4->id,
    'content' => "Il a l’air en forme, je préfère attendre quelques mois.",
    'next_chapter_id' => $chapter2_5->id,
    'impact_bonheur' => 1,
    'impact_sante' => 0,
    'impact_energie' => 0,
]);

// Chapitre 5
Choice::create([
    'chapter_id' => $chapter2_5->id,
    'content' => "Je laisse faire : ils doivent apprendre à cohabiter.",
    'next_chapter_id' => $chapter2_6->id,
    'impact_bonheur' => -2,
    'impact_sante' => 0,
    'impact_energie' => -1,
]);

Choice::create([
    'chapter_id' => $chapter2_5->id,
    'content' => "Je rassure mon chat et l’isole dans une pièce calme pour qu’il se détende.",
    'next_chapter_id' => $chapter2_6->id,
    'impact_bonheur' => 2,
    'impact_sante' => 1,
    'impact_energie' => 0,
]);

// Chapitre 6
Choice::create([
    'chapter_id' => $chapter2_6->id,
    'content' => "Je sors sa canne à pêche et on joue ensemble pendant un bon moment.",
    'next_chapter_id' => $chapter2_7->id,
    'impact_bonheur' => 3,
    'impact_sante' => 1,
    'impact_energie' => 2,
]);

Choice::create([
    'chapter_id' => $chapter2_6->id,
    'content' => "Je suis épuisé(e)… tant pis, il jouera seul.",
    'next_chapter_id' => $chapter2_7->id,
    'impact_bonheur' => -1,
    'impact_sante' => 0,
    'impact_energie' => -1,
]);

        // STORY 3 : CHIEN
$story3 = Story::create([
    'title' => 'Ton premier mois avec ton chien',
]);

// 🐶 CHAPITRES (création d'abord)
$chapter3_1 = Chapter::create([
    'story_id' => $story3->id,
    'title' => 'Découverte de ton chien',
    'content' => "Bienvenue à la maison ! Ton nouveau compagnon canin arrive en remuant la queue, débordant d’énergie. Il court dans tous les sens, aboie joyeusement et renverse déjà une plante. Il a besoin de repères pour se sentir en sécurité. Que fais-tu en premier ?",
]);

$chapter3_2 = Chapter::create([
    'story_id' => $story3->id,
    'title' => 'Première nuit',
    'content' => "La première nuit approche. Ton chien regarde partout, semble un peu perdu et pleure doucement. Il n’a jamais dormi seul dans un nouvel endroit… Comment gères-tu la situation ?",
]);

$chapter3_3 = Chapter::create([
    'story_id' => $story3->id,
    'title' => 'Balade quotidienne',
    'content' => "Ton chien déborde d’énergie : la balade du jour est attendue avec impatience ! Il tire beaucoup en laisse et aboie sur les autres chiens. Comment réagis-tu ?",
]);

$chapter3_4 = Chapter::create([
    'story_id' => $story3->id,
    'title' => 'Visite chez le vétérinaire',
    'content' => "C’est le grand jour : direction le vétérinaire pour le premier check-up ! Ton chien tremble, tu ressens son stress. Quelle est ta réaction ?",
]);

$chapter3_5 = Chapter::create([
    'story_id' => $story3->id,
    'title' => 'Jeu ou repos ?',
    'content' => "En fin de journée, ton chien vient poser sa balle à tes pieds : il veut encore jouer ! Mais tu es épuisé(e) par ta journée… Quelle décision prends-tu ?",
]);

$chapter3_6 = Chapter::create([
    'story_id' => $story3->id,
    'title' => 'Rencontre avec d’autres chiens',
    'content' => "Au parc, ton chien rencontre d’autres chiens pour la première fois. Il saute, aboie, semble surexcité. Quelle attitude adoptes-tu ?",
]);

$chapter3_7 = Chapter::create([
    'story_id' => $story3->id,
    'title' => 'Bilan du premier mois',
    'content' => "Un mois déjà avec ton fidèle compagnon ! Entre moments de joie, d’apprentissage et de petits défis, tu observes les progrès réalisés. Ton chien semble heureux et tu ressens cette belle complicité naissante.",
]);

// ✅ CHOICES (ensuite)

// Chapitre 1
Choice::create([
    'chapter_id' => $chapter3_1->id,
    'content' => "Tu le sors faire une balade calme pour l’aider à se dépenser et découvrir le quartier.",
    'next_chapter_id' => $chapter3_2->id,
    'impact_bonheur' => 2,
    'impact_sante' => 2,
    'impact_energie' => 2,
]);

Choice::create([
    'chapter_id' => $chapter3_1->id,
    'content' => "Tu le laisses seul un moment pour qu’il s’habitue à la maison par lui-même.",
    'next_chapter_id' => $chapter3_2->id,
    'impact_bonheur' => -1,
    'impact_sante' => 0,
    'impact_energie' => 0,
]);

// Chapitre 2
Choice::create([
    'chapter_id' => $chapter3_2->id,
    'content' => "Je le laisse dormir près de moi pour le rassurer.",
    'next_chapter_id' => $chapter3_3->id,
    'impact_bonheur' => 3,
    'impact_sante' => 1,
    'impact_energie' => 1,
]);

Choice::create([
    'chapter_id' => $chapter3_2->id,
    'content' => "Je le laisse dans son panier malgré ses pleurs.",
    'next_chapter_id' => $chapter3_3->id,
    'impact_bonheur' => -1,
    'impact_sante' => 0,
    'impact_energie' => 0,
]);

// Chapitre 3
Choice::create([
    'chapter_id' => $chapter3_3->id,
    'content' => "Je reste patient(e) et l’encourage calmement à marcher sans tirer.",
    'next_chapter_id' => $chapter3_4->id,
    'impact_bonheur' => 2,
    'impact_sante' => 1,
    'impact_energie' => 1,
]);

Choice::create([
    'chapter_id' => $chapter3_3->id,
    'content' => "Je tire sur la laisse et le gronde fermement.",
    'next_chapter_id' => $chapter3_4->id,
    'impact_bonheur' => -2,
    'impact_sante' => 0,
    'impact_energie' => -1,
]);

// Chapitre 4
Choice::create([
    'chapter_id' => $chapter3_4->id,
    'content' => "Je le rassure en le caressant et en lui parlant doucement.",
    'next_chapter_id' => $chapter3_5->id,
    'impact_bonheur' => 2,
    'impact_sante' => 2,
    'impact_energie' => 0,
]);

Choice::create([
    'chapter_id' => $chapter3_4->id,
    'content' => "Je le laisse gérer seul son stress : il doit apprendre.",
    'next_chapter_id' => $chapter3_5->id,
    'impact_bonheur' => -1,
    'impact_sante' => 0,
    'impact_energie' => -1,
]);

// Chapitre 5
Choice::create([
    'chapter_id' => $chapter3_5->id,
    'content' => "Je joue quelques minutes avec lui malgré la fatigue.",
    'next_chapter_id' => $chapter3_6->id,
    'impact_bonheur' => 2,
    'impact_sante' => 1,
    'impact_energie' => 1,
]);

Choice::create([
    'chapter_id' => $chapter3_5->id,
    'content' => "Je lui dis non fermement et le renvoie à son panier.",
    'next_chapter_id' => $chapter3_6->id,
    'impact_bonheur' => -2,
    'impact_sante' => 0,
    'impact_energie' => -1,
]);

// Chapitre 6
Choice::create([
    'chapter_id' => $chapter3_6->id,
    'content' => "Je surveille de loin et le laisse socialiser librement.",
    'next_chapter_id' => $chapter3_7->id,
    'impact_bonheur' => 2,
    'impact_sante' => 1,
    'impact_energie' => 2,
]);

Choice::create([
    'chapter_id' => $chapter3_6->id,
    'content' => "Je le tiens fermement en laisse pour éviter tout débordement.",
    'next_chapter_id' => $chapter3_7->id,
    'impact_bonheur' => 0,
    'impact_sante' => 0,
    'impact_energie' => 0,
]);
    }
}
