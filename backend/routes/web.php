<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\StoryController;
use App\Http\Controllers\Api\ChapterController;
use App\Http\Controllers\Api\ChoiceController;
use App\Http\Controllers\Api\StoryResultController;
use App\Http\Controllers\Api\UserChoiceController;   // 👈 ajoute ceci
/*
|---------------------------------------------------------------------------
| Routes
|---------------------------------------------------------------------------
*/

// === End-points API ===
Route::get('/api/stories',  [StoryController::class,      'index']);
Route::get('/api/chapters', [ChapterController::class,    'index']);
Route::get('/api/chapters/{id}', [ChapterController::class,'show']);
Route::get('/api/choices',  [ChoiceController::class,     'index']);
Route::post('/api/user-choices', [UserChoiceController::class, 'store']);  // 👈 nouvelle route
Route::get('/story1-result/{userId}', [StoryResultController::class,'show']);
// === Vue d’accueil SPA ===
Route::get('/', function () {
    return view('home');
});
