<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserChoiceController extends Controller
{
    // POST /api/user-choices
    public function store(Request $request)
{
    $request->validate([
        'choice_id' => 'required|exists:choices,id',
    ]);

    UserChoice::create([
        'choice_id' => $request->choice_id,
        'user_id'   => $request->user_id ?? 1,   // 1 = ID fixe tant que tu n’as pas d’auth
    ]);

    return response()->json(['message' => 'Choix enregistré']);
}
}