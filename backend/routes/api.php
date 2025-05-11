<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\{
    StoryController,
    ChapterController,
    ChoiceController,
    UserChoiceController,
    StoryResultController
};

Route::get('stories',        [StoryController::class,   'index']);
Route::get('chapters',       [ChapterController::class, 'index']);
Route::get('chapters/{id}',  [ChapterController::class, 'show']);
Route::get('choices',        [ChoiceController::class,  'index']);

Route::post('user-choices',       [UserChoiceController::class, 'store']);
Route::post('user-choices/reset', [UserChoiceController::class, 'reset']);

Route::get('story1-result/{userId}', [StoryResultController::class, 'show']);
