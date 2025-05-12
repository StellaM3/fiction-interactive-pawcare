<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Enums\ScoreType;
use App\Traits\JsonResponseTrait;

/**
 * Gère le calcul et l'affichage des résultats de l'histoire interactive
 * Détermine la prochaine histoire basée sur les choix de l'utilisateur
 * Utilise un système de score pour suivre les préférences chat/chien
 */
class StoryResultController extends Controller
{
    //Utilise JsonResponseTrait pour standardiser les réponses API
    use JsonResponseTrait;


        /**
     * Calcule et affiche le résultat pour un utilisateur spécifique
     * GET /api/story1-result/{userId}
     *
     * @param int $userId Identifiant de l'utilisateur
     * @return \Illuminate\Http\JsonResponse Contient:
     *      - next_story_id: ID de la prochaine histoire (2 pour chat, 3 pour chien)
     *      - scores: Tableau des scores {'chat': X, 'chien': Y}
     * 
     * Processus:
     * 1. Joint les tables user_choices, choices et chapters
     * 2. Filtre par utilisateur et histoire (id=1)
     * 3. Compte les choix par type (chat/chien)
     * 4. Détermine la prochaine histoire selon le score le plus élevé
     */
    public function show(int $userId)
    {
        $counts = DB::table('user_choices')
            ->join('choices', 'choices.id', '=', 'user_choices.choice_id')
            ->join('chapters', 'chapters.id', '=', 'choices.chapter_id')
            ->where('user_choices.user_id', $userId)
            ->where('chapters.story_id', 1)
            ->select('choices.score_type', DB::raw('COUNT(*) as total'))
            ->groupBy('choices.score_type')
            ->pluck('total', 'choices.score_type');

        $chat = $counts[ScoreType::CHAT->value] ?? 0;
        $chien = $counts[ScoreType::CHIEN->value] ?? 0;
        $next = $chien > $chat ? 3 : 2;

        return response()->json([
            'next_story_id' => $next,
            'scores' => ['chat' => $chat, 'chien' => $chien],
        ]);
    }
}