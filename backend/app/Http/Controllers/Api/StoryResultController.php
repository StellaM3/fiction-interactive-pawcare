<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Enums\ScoreType;
use App\Traits\JsonResponseTrait;

class StoryResultController extends Controller
{
    use JsonResponseTrait;

    public function show(int $userId)
    {
        $counts = DB::table('user_choices')
            ->join('choices', 'choices.id', '=', 'user_choices.choice_id')
            ->join('chapters', 'chapters.id', '=', 'choices.chapter_id')
            ->where('user_choices.user_id', $userId)
            ->where('chapters.story_id', 1)
            ->select('choices.score_type', DB::raw('COUNT(*) as total'))
            ->groupBy('choices.score_type')
            ->pluck('total', 'choices.score_type');

        $chat = $counts[ScoreType::CHAT->value] ?? 0;
        $chien = $counts[ScoreType::CHIEN->value] ?? 0;
        $next = $chien > $chat ? 3 : 2;

        return response()->json([
            'next_story_id' => $next,
            'scores' => ['chat' => $chat, 'chien' => $chien],
        ]);
    }
}