<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\ScoreType;

class Choice extends Model
{
    use HasFactory;

    protected $fillable = [
        'chapter_id',
        'content',
        'next_chapter_id',
        'score_type',
        'impact_bonheur',
        'impact_sante',
        'impact_energie',
    ];

    // ← Cast automatique de la colonne score_type vers l’enum
    protected $casts = [
        'score_type' => ScoreType::class,
    ];

    public function chapter()     { return $this->belongsTo(Chapter::class); }
    public function nextChapter() { return $this->belongsTo(Chapter::class, 'next_chapter_id'); }
}
