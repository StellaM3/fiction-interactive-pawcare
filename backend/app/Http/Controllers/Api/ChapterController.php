<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Chapter;
use App\Traits\JsonResponseTrait;

/**
 * Gère les opérations CRUD pour les chapitres de l'histoire interactive
 * Utilise JsonResponseTrait pour formater les réponses API
 */
class ChapterController extends Controller
{   
     
    //Utilise le trait pour formater les réponses JSON de manière cohérente
    use JsonResponseTrait;

     /**
     * Récupère tous les chapitres avec leurs choix associés
     * GET /api/chapters
     * @return \Illuminate\Http\JsonResponse Liste de tous les chapitres et leurs choix
     */
    public function index()
    {
        return response()->json(Chapter::with('choices')->get());
    }
   
    /**
     * Récupère un chapitre spécifique avec ses choix
     * GET /api/chapters/{id}
     * @param int $id Identifiant du chapitre
     * @return \Illuminate\Http\JsonResponse Le chapitre demandé et ses choix
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException Si le chapitre n'existe pas
     */
    public function show($id)
    {
        $chapter = Chapter::with('choices')->findOrFail($id);
        return response()->json($chapter);
    }
}