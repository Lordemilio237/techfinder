<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator; // <--- Étape CRUCIALE : on importe le moteur de pagination

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // On indique à Laravel d'utiliser les composants Tailwind pour générer le HTML des liens
        Paginator::useTailwind();
    }
}