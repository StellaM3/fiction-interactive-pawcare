<?php
/**
 * Liste des Service Providers de l'application
 * 
 * Les Service Providers sont le point central de bootstrap de Laravel:
 * - Enregistrent les composants dans le container IoC
 * - Configurent les services de l'application
 * - Initialisent les fonctionnalités globales
 * 
 * AppServiceProvider est le provider principal qui:
 * - Configure les routes (web.php, api.php)
 * - Initialise les middlewares globaux
 * - Définit les paramètres par défaut
 */
return [
    App\Providers\AppServiceProvider::class,
];
