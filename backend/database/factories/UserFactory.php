<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 *  * Factory pour la création d'utilisateurs de test
 * Génère des données aléatoires mais cohérentes pour:
 * - Nom d'utilisateur
 * - Email unique
 * - Mot de passe hashé
 * - Token de rappel
 * 
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Le mot de passe courant utilisé par la factory
     * Stocké en static pour optimiser les performances
     */
    protected static ?string $password;

    /**
     * Définit l'état par défaut du modèle User
     * Utilise Faker pour générer des données réalistes
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     *  État alternatif: email non vérifié
     * Utilisé pour tester la vérification d'email
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
