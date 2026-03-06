<?php

namespace App\Providers;

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
        // pengecekan agar super admin memeiliki all permission yg di define pada permissions spatie kita di RolePermissionSeeder
        Gate::before(function($user, $ability){
            if($user->hasRole('super_admin')){
                return true;
            }
        });
    }
}
