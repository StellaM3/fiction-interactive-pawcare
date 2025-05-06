<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Story;
use Illuminate\Http\Request;

class StoryController extends Controller
{
    public function index()
    {
        // Récupérer toutes les histoires avec leurs chapitres et les choix de chaque chapitre
        $stories = Story::with('chapters.choices')->get();

        return response()->json([
            'data' => $stories
        ]);
    }
}
