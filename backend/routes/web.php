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

/* ---------- API ---------- */
//Route::get ('/api/stories',                [StoryController::class,      'index']);
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
Route::get('/login', [AuthController::class, 'getAuthenticateForm']);
//Route::post('/login', [AuthController::class, 'login']);
Route::post('/authenticate', [AuthController::class, 'authenticate']);
// Routes protégées (nécessitant authentification)
Route::post('/logout', [AuthController::class, 'logout']);

Route::get('/create', [CreateStoryController::class, 'create']);
Route::middleware('auth:web')->group(function () {
   
  });
// Routes admin (nécessitant authentification + rôle admin)
Route::middleware(['auth:web', 'api.access'])->group(function () {
    Route::get('admin', [StoryController::class, 'store']);
    
});
