<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Story;
use App\Traits\JsonResponseTrait;

/**
 * Gère les opérations CRUD pour les histoires interactives
 * Chaque histoire contient plusieurs chapitres, qui eux-mêmes contiennent des choix
 */
class StoryController extends Controller
{
    /**
     * Utilise le trait pour formater les réponses JSON de manière cohérente
     * Permet d'avoir un format de réponse standardisé dans toute l'API
     */
    use JsonResponseTrait;


    /**
     * Récupère toutes les histoires avec leurs chapitres et choix
     * GET /api/stories
     * 
     * @return \Illuminate\Http\JsonResponse Collection d'histoires avec relations
     * @throws ApiException Si une erreur survient pendant la récupération
     * 
     * Utilise le chargement eager (with) pour charger:
     * - Les chapitres de chaque histoire
     * - Les choix de chaque chapitre
     * Évite ainsi le problème N+1 des requêtes
     */
    public function index()
    {
        try {
            $stories = Story::with('chapters.choices')->get();
            return response()->json($stories);
        } catch (\Exception $e) {
            throw new ApiException('Failed to retrieve stories', 500);
        }
    }
}
