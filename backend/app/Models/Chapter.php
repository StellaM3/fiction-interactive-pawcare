<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Modèle représentant un chapitre d'histoire
 * Relations: belongsTo Story, hasMany Choice
 */
class Chapter extends Model
{
    use HasFactory;
    //Champs modifiables en masse
    protected $fillable = ['story_id', 'title', 'content'];
    //Histoire parente du chapitre
    public function story()
    {
        return $this->belongsTo(Story::class);
    }
    //Choix disponibles dans ce chapitre
    public function choices()
    {
        return $this->hasMany(Choice::class);
    }
}
