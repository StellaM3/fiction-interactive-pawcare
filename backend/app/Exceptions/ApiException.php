<?php

namespace App\Exceptions;

use Exception;

/**
 * Exception personnalisée pour les erreurs API
 * Permet de définir un message d'erreur et un code HTTP personnalisé
 * 
 * Utilisée pour:
 * - Gérer les erreurs métier de l'API
 * - Retourner des codes HTTP appropriés
 * - Maintenir une cohérence dans les réponses d'erreur
 */
class ApiException extends Exception
{

    /**
     * Code HTTP de la réponse
     * Par défaut: 400 Bad Request
     */
    protected $statusCode;

    public function __construct($message = '', $statusCode = 400)
    {
        parent::__construct($message);
        $this->statusCode = $statusCode;
    }

    public function getStatusCode()
    {
        return $this->statusCode;
    }
}