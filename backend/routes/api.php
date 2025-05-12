<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\{
    StoryController,
    ChapterController,
    ChoiceController,
    UserChoiceController,
    StoryResultController,
    AuthController
};
/**
 * Routes API de l'application PawCare
 * Toutes les routes sont préfixées par /api/v1
 * Format de réponse: JSON
 */
Route::prefix('v1')->group(function () {
     /**
     * Routes publiques (lecture seule)
     * 
     * GET endpoints:
     * - /stories: Liste toutes les histoires
     * - /chapters: Liste tous les chapitres
     * - /chapters/{id}: Détails d'un chapitre
     * - /choices: Liste tous les choix disponibles
     * 
     * POST endpoints:
     * - /user-choices: Enregistre un choix utilisateur
     * - /user-choices/reset: Réinitialise les choix
     * 
     * Résultats:
     * - /story1-result/{userId}: Calcule le résultat pour l'histoire 1
     */
 
    Route::get('stories', [StoryController::class, 'index']);
    Route::get('chapters', [ChapterController::class, 'index']);
    Route::get('chapters/{id}', [ChapterController::class, 'show']);
    Route::get('choices', [ChoiceController::class, 'index']); 
    Route::post('user-choices', [UserChoiceController::class, 'store']);
    Route::post('user-choices/reset', [UserChoiceController::class, 'reset']);
    Route::get('story1-result/{userId}', [StoryResultController::class, 'show']);
    
});


