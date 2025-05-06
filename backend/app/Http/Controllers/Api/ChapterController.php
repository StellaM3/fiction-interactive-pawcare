<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Chapter;
use Illuminate\Http\Request;

class ChapterController extends Controller
{
    // GET /api/chapters
    public function index()
    {
        return response()->json(Chapter::with('choices')->get());
    }

    // GET /api/chapters/{id}
    public function show($id)
    {
        $chapter = Chapter::with('choices')->findOrFail($id);
        return response()->json($chapter);
    }
}