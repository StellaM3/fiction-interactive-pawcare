<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Choice;
use Illuminate\Http\Request;

class ChoiceController extends Controller
{
    // GET /api/choices
    public function index()
    {
        return response()->json(Choice::with('chapter')->get());
    }
}