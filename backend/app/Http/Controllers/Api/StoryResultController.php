<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class StoryResultController extends Controller
{
    public function show(int $userId)
    {
        // on regarde UNIQUEMENT les choix réellement cliqués
        $base = DB::table('user_choices')
            ->join('choices',   'choices.id',   '=', 'user_choices.choice_id')
            ->join('chapters',  'chapters.id',  '=', 'choices.chapter_id')
            ->where('user_choices.user_id', $userId)
            ->where('chapters.story_id', 1);

        $chat  = (clone $base)->where('choices.score_type', 'chat' )->count();
        $chien = (clone $base)->where('choices.score_type', 'chien')->count();

        $next  = $chat >= $chien ? 2 : 3;   // égalité → Chat

        return response()->json([
            'next_story_id' => $next,
            'scores'        => ['chat' => $chat, 'chien' => $chien],
        ]);
    }
}