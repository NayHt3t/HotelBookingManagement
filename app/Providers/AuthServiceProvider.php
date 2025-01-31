<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Gate::define('isAdmin', function(User $user){
            return $user->role == 'admin';
        });
        Gate::define('isManager', function(User $user){
            return $user->role == 'manager';
        });
        Gate::define('isAdminOrManager', function(User $user){
            return in_array($user->role,['admin','manager']);
        });
    }
}
