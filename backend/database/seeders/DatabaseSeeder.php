<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seeder pour créer l'histoire interactive
        $this->call([
            StorySeeder::class,
        ]);

        // Seeder pour créer un utilisateur de test (si tu veux le garder)
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
