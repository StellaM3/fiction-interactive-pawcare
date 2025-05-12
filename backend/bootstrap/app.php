<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

/**
 * Point d'entrée principal de l'application Laravel
 * Configure et initialise l'application avec:
 * - Routes (web, console, health check)
 * - Middleware globaux
 * - Gestionnaire d'exceptions
 */
return Application::configure(basePath: dirname(__DIR__))
/**
     * Configuration des routes principales:
     * - web.php: Routes pour l'interface web
     * - console.php: Commandes artisan personnalisées
     * - /up: Endpoint de health check
     */
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
     /**
     * Configuration des middleware globaux
     * Interceptent et traitent les requêtes HTTP
     */
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    /**
     * Configuration du gestionnaire d'exceptions
     * Définit comment l'application gère les erreurs
     */
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
