<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ValidateApiAccess
{
    public function handle(Request $request, Closure $next)
    {
        // Vérifier le header API-Key
        if (!$request->header('API-Key') || $request->header('API-Key') !== config('app.api_key')) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized access'
            ], 401);
        }

        return $next($request);
    }
}