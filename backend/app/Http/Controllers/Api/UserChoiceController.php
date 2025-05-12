<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserChoiceRequest;
use App\Http\Requests\ResetUserChoicesRequest;
use App\Models\UserChoice;

class UserChoiceController extends Controller
{
    public function store(UserChoiceRequest $request)
    {
        $validated = $request->validated();
        
        $userChoice = UserChoice::create([
            'user_id' => $validated['user_id'],
            'choice_id' => $validated['choice_id']
        ]);

        return response()->json(['status' => 'ok'], 201);
    }

    public function reset(ResetUserChoicesRequest $request)
    {
        $validated = $request->validated();
        
        UserChoice::where('user_id', $validated['user_id'])->delete();

        return response()->json(['status' => 'ok']);
    }
}