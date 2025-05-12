<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

/**
 * Middleware de protection CSRF
 * 
 * Ce middleware:
 * - Protège l'application contre les attaques CSRF (Cross-Site Request Forgery)
 * - Vérifie la présence et la validité du token CSRF pour chaque requête POST
 * - Permet d'exclure certaines routes de cette vérification (via $except)
 */
class VerifyCsrfToken extends Middleware
{ /**
    * Liste des routes exclues de la vérification CSRF
    * 
    * Ces routes peuvent être appelées sans token CSRF, utile pour:
    * - Les webhooks
    * - Les API publiques
    * - Les endpoints qui nécessitent des requêtes sans session
    * 
    * @var array<int,string>
    */
    protected $except = [
        'api/user-choices',
        'api/user-choices/reset',
    ];
}
