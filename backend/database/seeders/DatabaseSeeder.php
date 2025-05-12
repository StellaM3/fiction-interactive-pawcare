<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
/**
 * Seeder principal de l'application
 * Initialise la base de données avec:
 * - L'histoire interactive complète (via StorySeeder)
 * - Deux comptes utilisateurs pour les tests
 */
class DatabaseSeeder extends Seeder
{
    /**
     * * Seed the application's database.
     * Ordre d'exécution important:
     * 1. Histoire et contenu (dépendances)
     * 2. Utilisateur invité (pour tests)
     * 3. Compte administrateur (accès complet)
     */
    public function run(): void
    {
        // Seeder pour créer l'histoire interactive
        $this->call([
            StorySeeder::class,
        ]);

        // Seeder pour créer un utilisateur de test guest
        User::factory()->create([
            'name' => 'Guest',
            'email' => 'test@example.com',
            'password' => '123456', 
        ]);
         // Création du compte administrateur pour la gestion du contenu
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'role' => 'admin',
            'password' => '123456', 
        ]);
    }
}
