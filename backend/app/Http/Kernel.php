<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * Middlewares globaux exécutés pour chaque requête HTTP.
     */
    protected $middleware = [
        // –– middlewares par défaut de Laravel ––
        \Illuminate\Foundation\Http\Middleware\HandlePrecognitiveRequests::class,
        \Illuminate\Http\Middleware\TrustHosts::class,
        \Illuminate\Http\Middleware\TrustProxies::class,
        \Illuminate\Http\Middleware\HandleCors::class,
        \App\Http\Middleware\PreventRequestsDuringMaintenance::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \App\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,

        // ✅  notre CSRF avec l’exemption API
        \App\Http\Middleware\VerifyCsrfToken::class,
    ];

    /**
     * Groupes de middlewares.
     */
    protected $middlewareGroups = [
        'web' => [
            \Illuminate\Cookie\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            // VerifyCsrfToken est déjà ajouté en global
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],

        'api' => [
            // throttle = limitation de requêtes (facultatif)
            \Illuminate\Routing\Middleware\ThrottleRequests::class.':api',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
    ];

    /**
     * Middlewares route individuels (alias utilisables dans Route::middleware()).
     */
    protected $routeMiddleware = [
        'auth'       => \App\Http\Middleware\Authenticate::class,
        'throttle'   => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'bindings'   => \Illuminate\Routing\Middleware\SubstituteBindings::class,
        // … ajoute d’autres alias au besoin
    ];
}
