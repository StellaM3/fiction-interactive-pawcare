<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class ValidateApiAccess
{
    public function handle(Request $request, Closure $next): Response
    {
        /* if (!$request->header('X-API-Key') || $request->header('X-API-Key') !== 'pawcare_2025') {
            return response()->json([
                'status' => 'error',
                'message' => 'Accès non autorisé'
            ], 401);
        } */

        if(Auth::user()?->role !== 'admin') {
            return response()->json([
                'status' => 'error',
                'message' => 'Accès non autorisé'
            ], 401);
        }

        return $next($request);
    }
}