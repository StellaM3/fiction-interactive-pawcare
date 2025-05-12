<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

/**
 * Routes de commandes console (Artisan)
 * Ce fichier définit les commandes personnalisées pour l'application
 * 
 * Commandes disponibles:
 * - inspire: Affiche une citation inspirante
 * 
 * Utilisation:
 * php artisan inspire
 */

/**
 * Commande 'inspire'
 * Affiche une citation aléatoire depuis la collection Inspiring
 * Cette commande sert principalement d'exemple pour la création
 * de commandes Artisan personnalisées
 */
Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');
