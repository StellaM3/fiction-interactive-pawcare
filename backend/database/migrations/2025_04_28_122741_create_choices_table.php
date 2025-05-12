<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration pour créer la table des choix
 * Cette table stocke:
 * - Les choix disponibles dans chaque chapitre
 * - Le chapitre suivant associé à chaque choix
 * - L'impact du choix sur le score (chat/chien)
 */
return new class extends Migration
{
    /**
     * Crée la table choices avec:
     * - id: Identifiant unique auto-incrémenté
     * - chapter_id: Clé étrangère vers le chapitre parent (cascade)
     * - content: Texte du choix présenté à l'utilisateur
     * - score_type: Type de score impacté (chat/chien)
     * - next_chapter_id: Chapitre suivant (nullable, set null on delete)
     * - timestamps: Dates de création et modification
     */
    public function up(): void
    {
        Schema::create('choices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('chapter_id')->constrained()->onDelete('cascade');
            $table->string('content'); 
            $table->string('score_type')->nullable(); 
            $table->foreignId('next_chapter_id')->nullable()->constrained('chapters')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     *  Supprime la table choices
     * Table pivot - pas besoin de cascade car déjà géré par les foreign keys
     */
    public function down(): void
    {
        Schema::dropIfExists('choices');
    }
};
