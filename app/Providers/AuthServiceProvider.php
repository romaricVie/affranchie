<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
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

        //Gate
        Gate::define('manage-users', function ($user) {
         return $user->hasAnyRoles(['superAdministrateur','administrateur','moderateur'])
                ? Response::allow()
                : Response::deny('Accès non autorisé à cette page.');
           });

        Gate::define('super-admin', function ($user) {
         return $user->hasAnyRoles(['superAdministrateur','administrateur'])
                ? Response::allow()
                : Response::deny('Accès non autorisé à cette page.');
           });

        Gate::define('gestion-utilisateur', function ($user) {
                 return $user->superAdmin()
                        ? Response::allow()
                        : Response::deny('Accès non autorisé à cette page.');
                   });
        

    }
}
