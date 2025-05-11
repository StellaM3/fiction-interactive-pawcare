<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /** Routes sans vérification CSRF */
    protected $except = [
        'api/*',                 // ← toutes les routes API
    ];
}