<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Gestionnaire global des exceptions de l'application
 * Convertit les exceptions en réponses JSON pour l'API
 */
class Handler extends ExceptionHandler
{
    /**
     * Enregistre les handlers d'exceptions personnalisés
     * Traite spécifiquement les requêtes API avec préfixe api/*
     * 
     * Gère les cas suivants:
     * - ValidationException (422): Erreurs de validation formulaire
     * - ModelNotFoundException (404): Ressource non trouvée
     * - NotFoundHttpException (404): Route inexistante
     * - ApiException: Exceptions métier personnalisées
     * - Autres exceptions (500): Erreurs serveur inattendues
     */
    public function register(): void
    {
        $this->renderable(function (Throwable $e, $request) {
            if ($request->is('api/*')) {
                 // Erreurs de validation (422)
                if ($e instanceof ValidationException) {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Validation failed',
                        'errors' => $e->errors()
                    ], 422);
                }

                 // Ressource non trouvée (404)
                if ($e instanceof ModelNotFoundException) {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Resource not found'
                    ], 404);
                }

                // Route inexistante (404)
                if ($e instanceof NotFoundHttpException) {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Endpoint not found'
                    ], 404);
                }

                // Exceptions métier personnalisées
                if ($e instanceof ApiException) {
                    return response()->json([
                        'status' => 'error',
                        'message' => $e->getMessage()
                    ], $e->getStatusCode());
                }

                // Toute autre exception inattendue (500)
                return response()->json([
                    'status' => 'error',
                    'message' => 'An unexpected error occurred',
                    'debug' => config('app.debug') ? $e->getMessage() : null
                ], 500);
            }
        });
    }
}