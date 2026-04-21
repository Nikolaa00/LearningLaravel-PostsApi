<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
class AppServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Gate::before(function (User $user, string $ability) {
            if ($user->is_admin ?? false) {
                return true;
            }
        });

        Gate::define('manage-platform', function (User $user) {
            return $user->is_admin ?? false;
        });
    }
}