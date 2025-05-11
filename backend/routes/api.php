<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\StoryController;
use App\Http\Controllers\Api\ChapterController;
use App\Http\Controllers\Api\ChoiceController;
use App\Http\Controllers\Api\UserChoiceController;
use App\Http\Controllers\Api\StoryResultController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/
Route::post('user-choices',       [UserChoiceController::class, 'store']);
Route::post('user-choices/reset', [UserChoiceController::class, 'reset']);  // ← ici !