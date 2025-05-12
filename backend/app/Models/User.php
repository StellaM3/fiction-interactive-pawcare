<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * Modèle User représentant les utilisateurs de l'application
 * Étend Authenticatable pour la gestion de l'authentification
 * 
 * Rôles possibles:
 * - 'admin': Accès complet (création d'histoires)
 * - 'user': Accès limité (lecture d'histoires)
 */
class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     * Seuls ces champs peuvent être remplis en masse via create() ou fill()
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role', 
    ];

    /**
     * The attributes that should be hidden for serialization.
     * Ces champs ne seront pas inclus lors de la sérialisation du modèle
     * Important pour la sécurité (mot de passe, token)
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *Définit la conversion automatique de certains champs
     * - email_verified_at: converti en objet DateTime
     * - password: hashé automatiquement
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Check if user is admin
     *Méthode helper pour vérifier rapidement si l'utilisateur est admin
     * Utilisée dans les middleware et policies pour le contrôle d'accès
     * @return bool
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }
}