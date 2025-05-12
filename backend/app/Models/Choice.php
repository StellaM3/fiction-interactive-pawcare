<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\ScoreType;

/**
 * Modèle représentant un choix dans l'histoire interactive
 * Relations: belongsTo Chapter (current + next)
 */
class Choice extends Model
{
    use HasFactory;

    /**
     * Champs modifiables en masse
     * Inclut les impacts sur les stats et le chapitre suivant
     */
    protected $fillable = [
        'chapter_id',
        'content',
        'next_chapter_id',
        'score_type',
        'impact_bonheur',
        'impact_sante',
        'impact_energie',
    ];

    //Cast automatique de la colonne score_type vers l'enum ScoreType
    protected $casts = [
        'score_type' => ScoreType::class,
    ];
    //Chapitre vers lequel ce choix mène
    public function chapter()     { return $this->belongsTo(Chapter::class); }
    public function nextChapter() { return $this->belongsTo(Chapter::class, 'next_chapter_id'); }
}
