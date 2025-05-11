<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\UserChoice;
use Illuminate\Http\Request;

class UserChoiceController extends Controller
{
    public function store(Request $request)
    {
        UserChoice::create([
            'user_id'   => $request->input('user_id', 1),
            'choice_id' => $request->input('choice_id'),
        ]);

        return response()->json(['status' => 'ok'], 201);
    }

    public function reset(Request $request)
    {
        UserChoice::where('user_id', $request->input('user_id', 1))->delete();
        return response()->json(['status' => 'reset']);
    }
}
