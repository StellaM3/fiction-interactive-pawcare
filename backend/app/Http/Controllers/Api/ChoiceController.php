<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Choice;
use App\Traits\JsonResponseTrait;

/**
 * Gère les opérations liées aux choix dans l'histoire interactive
 * Les choix représentent les options disponibles à chaque chapitre
 * Un choix est lié à un chapitre et peut mener à un autre chapitre
 */
class ChoiceController extends Controller
{
    /**
     * Utilise JsonResponseTrait pour formater les réponses API
     * de manière cohérente dans toute l'application
     */
    use JsonResponseTrait;

     /**
     * Récupère tous les choix disponibles avec leurs chapitres associés
     * GET /api/choices
     * 
     * @return \Illuminate\Http\JsonResponse Liste de tous les choix et leurs chapitres
     * Utilise le chargement eager avec 'chapter' pour éviter le problème N+1
     */
    public function index()
    {
        return response()->json(Choice::with('chapter')->get());
    }
}