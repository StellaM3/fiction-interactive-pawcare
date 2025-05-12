<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration pour ajouter les métriques d'impact aux choix
 * Cette migration modifie la table choices pour ajouter:
 * - Des indicateurs numériques de l'impact des choix
 * - Des valeurs par défaut à 0 pour chaque métrique
 */
return new class extends Migration
{
    /**
     * Ajoute trois colonnes d'impact à la table choices:
     * - impact_bonheur: Influence sur le niveau de bonheur (-100 à +100)
     * - impact_sante: Impact sur la santé de l'animal (-100 à +100)
     * - impact_energie: Effet sur le niveau d'énergie (-100 à +100)
     */
    public function up()
{
    Schema::table('choices', function (Blueprint $table) {
        $table->integer('impact_bonheur')->default(0);
        $table->integer('impact_sante')->default(0);
        $table->integer('impact_energie')->default(0);
    });
}
/**
     * Supprime les colonnes d'impact
     * Retire toutes les métriques en une seule opération
     * Cette action est irréversible - les valeurs seront perdues
     */
public function down()
{
    Schema::table('choices', function (Blueprint $table) {
        $table->dropColumn(['impact_bonheur', 'impact_sante', 'impact_energie']);
    });
}
};
