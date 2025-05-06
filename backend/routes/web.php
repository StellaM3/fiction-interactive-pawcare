<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\StoryController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application.
|
*/  use App\Http\Controllers\Api\ChapterController;
    use App\Http\Controllers\Api\ChoiceController;

    Route::get('api/stories', [StoryController::class, 'index']);
    Route::get('/api/chapters', [ChapterController::class, 'index']);
    Route::get('/api/chapters/{id}', [ChapterController::class, 'show']);
    Route::get('/api/choices', [ChoiceController::class, 'index']);
    Route::get('/', function () {
        return view('home');
    });