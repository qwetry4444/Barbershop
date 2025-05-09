<?php

namespace App\Providers;


use App\Models\User;
use App\Models\Visit;
use Illuminate\Pagination\Paginator;
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
     */
    public function boot(): void
    {
        Paginator::defaultView('pagination::default');

        Gate::define('destroy-visit', function (User $user) {
            return $user->role->name == "admin";
        });
        Gate::define('update-visit', function (User $user, Visit $visit) {
            return $user->role->name == "admin" || $user->role->name == "barber" && $visit->barber_id == $user->id;
        });
        Gate::define('create-visit', function (User $user) {
            return in_array($user->role->name, ['admin', 'barber']);
        });

        Gate::define('read-visits', function (User $user) {
            return in_array($user->role->name, ['admin', 'barber']);
        });

        Gate::define('read-visit', function (User $user, Visit $visit) {
            return in_array($user->role->name, ['admin', 'barber']) || $visit->client->id == $user->id;
        });
    }
}
