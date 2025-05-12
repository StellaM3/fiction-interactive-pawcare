<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Story;
use App\Traits\JsonResponseTrait;

class StoryController extends Controller
{
    use JsonResponseTrait;

    public function index()
    {
        try {
            $stories = Story::with('chapters.choices')->get();
            return response()->json($stories);
        } catch (\Exception $e) {
            throw new ApiException('Failed to retrieve stories', 500);
        }
    }
}
