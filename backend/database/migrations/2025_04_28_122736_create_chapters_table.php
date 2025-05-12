<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration pour créer la table des chapitres
 * Cette table stocke:
 * - Les chapitres individuels des histoires
 * - Les liens vers l'histoire parente
 * - Le contenu textuel de chaque chapitre
 */
return new class extends Migration
{
    /**
     *  Crée la table chapters avec:
     * - id: Identifiant unique auto-incrémenté
     * - story_id: Clé étrangère vers l'histoire parente (avec cascade delete)
     * - title: Titre du chapitre
     * - content: Contenu textuel du chapitre
     * - timestamps: Dates de création et modification
     */
    public function up(): void
    {
        Schema::create('chapters', function (Blueprint $table) {
            $table->id();
            $table->foreignId('story_id')->constrained()->onDelete('cascade');
            $table->string('title'); // <= AJOUTER CETTE LIGNE
            $table->text('content'); // déjà existant
            $table->timestamps();
        });
    }

    /**Supprime la table chapters
     * Les choix associés seront aussi supprimés via cascadeReverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chapters');
    }
};
