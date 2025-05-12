<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Choice;
use App\Traits\JsonResponseTrait;

class ChoiceController extends Controller
{
    use JsonResponseTrait;

    public function index()
    {
        return response()->json(Choice::with('chapter')->get());
    }
}