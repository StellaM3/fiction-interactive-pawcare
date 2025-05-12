<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

/**
 * Middleware de validation d'accès à l'API
 * Vérifie les autorisations avant d'accéder aux routes protégées
 */
class ValidateApiAccess
{

    /**
     * Gère la requête entrante
     * 
     * @param Request $request La requête HTTP entrante
     * @param Closure $next La fonction suivante dans la chaîne middleware
     * @return Response La réponse HTTP
     * 
     * Cette méthode:
     * 1. Vérifie si l'utilisateur est authentifié et a le rôle 'admin'
     * 2. Renvoie une erreur 401 si non autorisé
     * 3. Passe la requête au middleware suivant si autorisé
     * 
     * Note: Une ancienne vérification de X-API-Key est commentée
     * mais conservée pour référence future
     */
    public function handle(Request $request, Closure $next): Response
    {
        

        if(Auth::user()?->role !== 'admin') {
            return response()->json([
                'status' => 'error',
                'message' => 'Accès non autorisé'
            ], 401);
        }

        return $next($request);
    }
}