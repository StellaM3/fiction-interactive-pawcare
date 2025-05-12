<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\{
    StoryController,
    ChapterController,
    ChoiceController,
    StoryResultController,
    UserChoiceController,
    AuthController,
   
};
use App\Http\Controllers\CreateStoryController;
use App\Models\UserChoice;

/**
 * Routes de l'application PawCare
 * Organisation:
 * 1. Routes API (données JSON)
 * 2. Routes SPA (vues Laravel)
 * 3. Routes protégées (auth requise)
 * 4. Routes admin (auth + rôle admin)
 */

/* ---------- API ---------- */
// Endpoints API publics
// Retournent les données en JSON pour le frontend
//Route::get ('/api/stories',                [StoryController::class,      'index']);
Route::get ('/api/chapters',               [ChapterController::class,    'index']);
Route::get ('/api/chapters/{id}',          [ChapterController::class,    'show']);
Route::get ('/api/choices',                [ChoiceController::class,     'index']);



/* ---------- Page SPA ---------- */
// Routes accessibles sans authentification
// Renvoient des vues pour l'application monolithique
Route::get('/', fn () => view('home'));
Route::get('/login', [AuthController::class, 'getAuthenticateForm']);
Route::post('/authenticate', [AuthController::class, 'authenticate']);
Route::post('/logout', [AuthController::class, 'logout']);
Route::get('/create', [CreateStoryController::class, 'create']);

// Routes protégées (utilisateur connecté)
Route::middleware('auth:web')->group(function () {
   
  });
// Routes admin (nécessitant authentification + rôle admin)
Route::middleware(['auth:web', 'api.access'])->group(function () {
    Route::get('admin', [StoryController::class, 'store']);
    
});
