<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration pour créer les tables de gestion des jobs
 * Crée trois tables essentielles:
 * - jobs: Stocke les jobs en attente d'exécution
 * - job_batches: Gère les lots de jobs
 * - failed_jobs: Enregistre les jobs qui ont échoué
 */
return new class extends Migration
{
    /**
     * Crée les tables de gestion des jobs
     * 
     * Table jobs:
     * - Stocke les jobs en file d'attente
     * - Suit les tentatives et la disponibilité
     * - Gère la priorité via queue
     * 
     * Table job_batches:
     * - Gère des groupes de jobs liés
     * - Suit la progression et les échecs
     * - Permet l'annulation de lots
     * 
     * Table failed_jobs:
     * - Enregistre les jobs échoués
     * - Stocke les détails d'erreur
     * - Permet la relance des jobs
     */
    public function up(): void
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->string('queue')->index();
            $table->longText('payload');
            $table->unsignedTinyInteger('attempts');
            $table->unsignedInteger('reserved_at')->nullable();
            $table->unsignedInteger('available_at');
            $table->unsignedInteger('created_at');
        });

        Schema::create('job_batches', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('name');
            $table->integer('total_jobs');
            $table->integer('pending_jobs');
            $table->integer('failed_jobs');
            $table->longText('failed_job_ids');
            $table->mediumText('options')->nullable();
            $table->integer('cancelled_at')->nullable();
            $table->integer('created_at');
            $table->integer('finished_at')->nullable();
        });

        Schema::create('failed_jobs', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->text('connection');
            $table->text('queue');
            $table->longText('payload');
            $table->longText('exception');
            $table->timestamp('failed_at')->useCurrent();
        });
    }

    /**
     * Supprime les tables dans l'ordre inverse
     * Nettoie toutes les données de jobs
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs');
        Schema::dropIfExists('job_batches');
        Schema::dropIfExists('failed_jobs');
    }
};
