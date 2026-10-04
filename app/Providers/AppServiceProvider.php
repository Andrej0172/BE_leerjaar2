<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

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
     *
     * De rechten van de opdracht zitten hier als Gates: de routes en de
     * navigatie vragen ze aan, zodat een gebruiker zonder recht ook via de
     * URL niet bij een scherm kan komen (403 in plaats van alleen een
     * verborgen link).
     */
    public function boot(): void
    {
        Gate::define('magazijn.bekijken', function (User $gebruiker) {
            return $gebruiker->magMagazijnZien();
        });

        Gate::define('magazijn.voorraad-bijwerken', function (User $gebruiker) {
            return $gebruiker->isAdministrator();
        });

        Gate::define('gebruiker.beheren', function (User $gebruiker) {
            return $gebruiker->isAdministrator();
        });
    }
}
