<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration pour créer la table des histoires interactives
 * Cette table est la table principale qui contient:
 * - Les informations de base des histoires
 * - Les liens vers les chapitres associés
 */
return new class extends Migration
{
    /**
     * Crée la table stories avec:
     * - id: Identifiant unique auto-incrémenté
     * - title: Titre de l'histoire
     * - description: Description optionnelle de l'histoire
     * - timestamps: Dates de création et modification
     */
    public function up(): void
    {
        Schema::create('stories', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Supprime la table stories
     * Cette action supprime aussi tous les chapitres associés via cascade
     */
    public function down(): void
    {
        Schema::dropIfExists('stories');
    }
};
