<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
/**
 * Service Provider principal de l'application
 * Gère l'initialisation et la configuration globale
 */
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     * Utilisé pour enregistrer des services dans le container IoC
     * Appelé avant le boot()
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     * Configuration globale de l'application
     * - Routes API avec préfixe 'api/' et middleware 'api'
     * - Routes Web avec middleware 'web' pour sessions/CSRF
     */
    public function boot(): void
    {
        // ——— Chargement des routes API ———
        Route::prefix('api')
             ->middleware('api')
             ->group(base_path('routes/api.php'));

        // ——— Chargement des routes Web (views, etc.) ———
        Route::middleware('web')
             ->group(base_path('routes/web.php'));
    }
}
