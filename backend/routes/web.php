<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\{
    StoryController,
    ChapterController,
    ChoiceController,
    StoryResultController,
    UserChoiceController
};
use App\Models\UserChoice;

/* ---------- API ---------- */
Route::get ('/api/stories',                [StoryController::class,      'index']);
Route::get ('/api/chapters',               [ChapterController::class,    'index']);
Route::get ('/api/chapters/{id}',          [ChapterController::class,    'show']);
Route::get ('/api/choices',                [ChoiceController::class,     'index']);

Route::post('/api/user-choices',           [UserChoiceController::class, 'store']);
Route::post('/api/user-choices/reset', function (Request $r) {
    UserChoice::where('user_id', $r->input('user_id', 1))->delete();
    return response()->json(['message' => 'reset ok']);
});

Route::get ('/api/story1-result/{userId}', [StoryResultController::class,'show']);

/* ---------- Page SPA ---------- */
Route::get('/', fn () => view('home'));
