<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration initiale pour la création des tables d'authentification
 * Crée trois tables essentielles:
 * - users: Stocke les données utilisateurs
 * - password_reset_tokens: Gère la réinitialisation des mots de passe
 * - sessions: Gère les sessions utilisateurs
 */
return new class extends Migration
{
    /**
     * Crée les tables nécessaires à l'authentification
     * 
     * Table users:
     * - Informations de base (nom, email)
     * - Sécurité (mot de passe, vérification email)
     * - Rôle utilisateur (admin/user)
     * - Timestamps et remember token
     * 
     * Table password_reset_tokens:
     * - Stocke les tokens de réinitialisation
     * - Lie le token à un email
     * 
     * Table sessions:
     * - Gère les sessions actives
     * - Stocke les données de connexion
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('role')->default('user');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Supprime les tables dans l'ordre inverse de création
     * Important: L'ordre évite les erreurs de clés étrangères
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
