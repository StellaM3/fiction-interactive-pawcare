<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration pour créer la table pivot user_choices
 * Cette table associe les utilisateurs à leurs choix:
 * - Enregistre l'historique des choix de chaque utilisateur
 * - Permet de suivre la progression dans l'histoire
 */
return new class extends Migration {
    /**
     * Crée la table user_choices avec:
     * - id: Identifiant unique auto-incrémenté
     * - user_id: Clé étrangère vers la table users
     * - choice_id: Clé étrangère vers la table choices
     */
    public function up(): void
    {
        Schema::create('user_choices', function (Blueprint $t) {
            $t->id();
            $t->foreignId('user_id');
            $t->foreignId('choice_id');
        });
    }
    /**
     * Supprime la table user_choices
     * Cette action efface l'historique des choix des utilisateurs
     */
    public function down(): void
    {
        Schema::dropIfExists('user_choices');
    }
};