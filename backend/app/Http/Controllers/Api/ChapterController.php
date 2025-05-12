<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Chapter;
use App\Traits\JsonResponseTrait;

class ChapterController extends Controller
{
    use JsonResponseTrait;

    public function index()
    {
        return response()->json(Chapter::with('choices')->get());
    }

    public function show($id)
    {
        $chapter = Chapter::with('choices')->findOrFail($id);
        return response()->json($chapter);
    }
}