<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * Gère les opérations liées aux utilisateurs
 * Fournit des endpoints API pour les fonctionnalités utilisateur
 */
class UserController extends Controller
{
    /**
     * Renvoie une réponse test pour vérifier que le contrôleur fonctionne
     * GET /api/users
     * 
     * @return \Illuminate\Http\JsonResponse Message de confirmation
     * 
     * Cette méthode est utilisée pour:
     * 1. Tester que la route est correctement configurée
     * 2. Vérifier que le contrôleur répond aux requêtes
     * 3. Valider le format de réponse JSON
     */
    public function index()
    {
        return response()->json([
            'message' => 'UserController is working!'
        ]);
    }
}