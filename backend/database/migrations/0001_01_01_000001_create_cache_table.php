<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration pour créer les tables de cache
 * Crée deux tables:
 * - cache: Stocke les données en cache
 * - cache_locks: Gère le verrouillage atomique du cache
 */
return new class extends Migration
{
    /**
     * Crée les tables de cache
     * 
     * Table cache:
     * - key: Identifiant unique de l'entrée en cache
     * - value: Donnée stockée (jusqu'à 16MB avec mediumText)
     * - expiration: Timestamp d'expiration
     * 
     * Table cache_locks:
     * - key: Identifiant unique du verrou
     * - owner: Propriétaire du verrou
     * - expiration: Durée de validité du verrou
     */
    public function up(): void
    {
        Schema::create('cache', function (Blueprint $table) {
            $table->string('key')->primary();
            $table->mediumText('value');
            $table->integer('expiration');
        });

        Schema::create('cache_locks', function (Blueprint $table) {
            $table->string('key')->primary();
            $table->string('owner');
            $table->integer('expiration');
        });
    }

    /**
     * Supprime les tables de cache
     * L'ordre n'est pas important car pas de clés étrangères
     */
    public function down(): void
    {
        Schema::dropIfExists('cache');
        Schema::dropIfExists('cache_locks');
    }
};
