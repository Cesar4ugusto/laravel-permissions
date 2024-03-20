<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Auth\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Gate::define('admin', function (User $user) {
            return $user->hasPermission('admin');
        });

        Gate::define('default', function (User $user) {
            return $user->hasPermission('manage-users');
        });
    }
}
