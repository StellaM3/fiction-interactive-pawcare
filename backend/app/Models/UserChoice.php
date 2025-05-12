<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * Modèle pivot entre User et Choice
 * Enregistre les choix faits par chaque utilisateur dans l'histoire
 */
class UserChoice extends Model
{
    use HasFactory;

    /**
     * Désactive les colonnes created_at et updated_at
     * Car on ne suit pas l'historique des modifications
     */
    public $timestamps = false;

    /**
     * Liste des champs autorisés pour l'assignation en masse
     * Limité aux IDs nécessaires pour la relation many-to-many
     */
    protected $fillable = ['user_id', 'choice_id'];

    /**
     * Relations avec les autres modèles:
     * - choice: Le choix sélectionné par l'utilisateur
     * - user: L'utilisateur qui a fait le choix
     */
    public function choice()   { return $this->belongsTo(Choice::class); }
    public function user()     { return $this->belongsTo(User::class); }
}