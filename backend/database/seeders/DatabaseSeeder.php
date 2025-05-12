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
            'name' => 'Guest',
            'email' => 'test@example.com',
            'password' => '123456', 
        ]);

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'role' => 'admin',
            'password' => '123456', 
        ]);
    }
}
