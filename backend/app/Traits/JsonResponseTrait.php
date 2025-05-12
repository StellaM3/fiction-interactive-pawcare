<?php

namespace App\Traits;

/**
 * Trait pour standardiser les réponses JSON de l'API
 * Fournit deux méthodes helper pour formater les réponses:
 * - successResponse: Pour les réponses positives avec données optionnelles
 * - errorResponse: Pour les erreurs avec message explicatif
 */
trait JsonResponseTrait
{
    //Formate une réponse JSON de succès
    protected function successResponse($data = null, $message = '', $code = 200)
    {
        return response()->json([
            'status' => 'success',
            'message' => $message,
            'data' => $data
        ], $code);
    }
    //Formate une réponse JSON d'erreur
    protected function errorResponse($message, $code = 400)
    {
        return response()->json([
            'status' => 'error',
            'message' => $message
        ], $code);
    }
}