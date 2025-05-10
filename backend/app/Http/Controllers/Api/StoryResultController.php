<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StoryResultController extends Controller
{
    public function show($userId)
    {
        // ✅ Compter combien de choix sont pour Chat ou Chien dans Story 1
        $chatScore = DB::table('choices')
            ->join('chapters', 'choices.chapter_id', '=', 'chapters.id')
            ->where('chapters.story_id', 1)
            ->where('choices.score_type', 'chat')
            ->count();

        $chienScore = DB::table('choices')
            ->join('chapters', 'choices.chapter_id', '=', 'chapters.id')
            ->where('chapters.story_id', 1)
            ->where('choices.score_type', 'chien')
            ->count();

        // 🐾 Déterminer la prochaine Story
        $nextStory = ($chatScore >= $chienScore) ? 'chat' : 'chien';
        $nextStoryId = ($nextStory === 'chat') ? 2 : 3;

        return response()->json([
            'next_story' => $nextStory,
            'next_story_id' => $nextStoryId,
            'scores' => [
                'chat' => $chatScore,
                'chien' => $chienScore
            ]
        ]);
    }
}
