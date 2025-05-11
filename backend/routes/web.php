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

/*  Enregistrement d'un choix --------------------------------------- */
//Route::post('api/user-choices', [App\Http\Controllers\Api\UserChoiceController::class, 'store']);

/*  Reset de tous les choix pour un utilisateur (Story 1) ----------- */
//Route::post('api/user-choices/reset', function (Request $request) {
    //$userId = $request->input('user_id', 1);          // 1 par défaut
    //UserChoice::where('user_id', $userId)->delete();

    //return response()->json(['message' => 'reset ok']);
//});

//Route::post('/api/user-choices',           [UserChoiceController::class, 'store']);
//Route::post('/api/user-choices/reset', function (Request $r) {
  //  UserChoice::where('user_id', $r->input('user_id', 1))->delete();
  //  return response()->json(['message' => 'reset ok']);
//});

//Route::get ('/api/story1-result/{userId}', [StoryResultController::class,'show']);

/* ---------- Page SPA ---------- */
Route::get('/', fn () => view('home'));
