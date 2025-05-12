<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Modèle représentant une histoire interactive
 * Contient une collection de chapitres
 */
class Story extends Model
{
    use HasFactory;
    //Champs modifiables en masse
    protected $fillable = ['title'];

    /**
     * Les chapitres appartenant à cette histoire
     * Relation one-to-many avec Chapter
     */
    public function chapters()
    {
        return $this->hasMany(Chapter::class);
    }
}
