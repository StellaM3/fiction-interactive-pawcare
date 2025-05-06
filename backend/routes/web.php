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
    use App\Http\Controllers\Api\StoryResultController;

    Route::get('api/stories', [StoryController::class, 'index']);
    Route::get('/api/chapters', [ChapterController::class, 'index']);
    Route::get('/api/chapters/{id}', [ChapterController::class, 'show']);
    Route::get('/api/choices', [ChoiceController::class, 'index']);
    Route::get('/', function () {
        return view('home');
    
        Route::get('/story1-result/{userId}', [StoryResultController::class, 'show']);
            
    });

    Route::get('/story1-result/{userId}', [StoryResultController::class, 'show']);