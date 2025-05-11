<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * URIs pour lesquelles on NE vérifie PAS le token CSRF
     * (nos appels AJAX depuis Vue).
     */
    protected $except = [
        'api/*',                  // ← règle large : toutes tes routes API
    ];
}