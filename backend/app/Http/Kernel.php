<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

/**
 * Noyau HTTP de l'application
 * Configure tous les middlewares qui traitent les requêtes HTTP
 * 
 * Ce fichier définit:
 * - Les middlewares globaux appliqués à toutes les requêtes
 * - Les groupes de middlewares (web, api) pour différents types de routes
 * - Les alias de middlewares pour une utilisation simplifiée dans les routes
 */
class Kernel extends HttpKernel
{
    /**
     * * Middleware globaux appliqués à TOUTES les requêtes HTTP
     * - HandleCors: Gère les requêtes cross-origin
     * - ValidatePostSize: Vérifie la taille des données POST
     * - TrimStrings: Nettoie les espaces en début/fin de chaîne
     * - ConvertEmptyStringsToNull: Convertit les chaînes vides en NULL
     * @var array<int, class-string|string>
     */
    protected $middleware = [
        \Illuminate\Http\Middleware\HandleCors::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \App\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
    ];

    /**
     * /**
     * Groupes de middlewares pour différents types de routes
     * 
     * Groupe 'web':
     * - EncryptCookies: Chiffre/déchiffre les cookies
     * - AddQueuedCookiesToResponse: Ajoute les cookies en file d'attente
     * - StartSession: Démarre la session PHP
     * - ShareErrorsFromSession: Partage les erreurs avec les vues
     * - SubstituteBindings: Effectue l'injection de dépendances dans les routes
     * 
     * Groupe 'api':
     * - ThrottleRequests: Limite le nombre de requêtes
     * - SubstituteBindings: Injection de dépendances pour l'API
     
     *
     * @var array<string, array<int, class-string|string>>
     */
    protected $middlewareGroups = [
        'web' => [
            \Illuminate\Cookie\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],

        'api' => [
            \Illuminate\Routing\Middleware\ThrottleRequests::class.':api',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
    ];

    /**
     * The application's middleware aliases.
     ** Alias de middlewares pour utilisation dans les routes
     * 
     * Permet d'utiliser des noms courts dans les routes:
     * - 'auth': Authentication middleware
     * - 'throttle': Limitation de requêtes
     * - 'bindings': Injection de dépendances
     * - 'api.access': Notre middleware personnalisé de validation API
     * @var array<string, class-string|string>
     */
    protected array $middlewareAliases = [
        'auth' => \App\Http\Middleware\Authenticate::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'bindings' => \Illuminate\Routing\Middleware\SubstituteBindings::class,
        'api.access' => \App\Http\Middleware\ValidateApiAccess::class
    ];
}