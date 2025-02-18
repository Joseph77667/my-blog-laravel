<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;

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
    //first run when program start
    public function boot(): void
    {
        //Model::unguarded(); -> unguarded for all model
        Paginator::useBootstrapFive();
        Paginator::useBootstrapFour();

        Gate::define('admin', function(User $user){
            return $user && $user->is_admin;
        });
    }
}
