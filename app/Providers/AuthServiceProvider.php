<?php

namespace App\Providers;

use App\Auth\AdminProvider;
use App\Auth\CoachProvider;
use App\Auth\AthleteProvider;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        \Auth::provider('admin_provider', function($app, array $config){
            return new AdminProvider($app['hash'], $config['model']);
        });

        \Auth::provider('coach_provider', function($app, array $config){
            return new CoachProvider($app['hash'], $config['model']);
        });

        \Auth::provider('athlete_provider', function($app, array $config){
            return new AthleteProvider($app['hash'], $config['model']);
        });

        /* Gate::before(function($user){
            if($user->containsType(Admin::class)){
                return true;
            }
        });

        Gate::define('coach', function($user){
            return $user->coach->pivot->userable_type == 'App\Models\Coach';
        });

        Gate::define('athlete', function($user){
            return $user->athlete->pivot->userable_type == 'App\Models\Athlete';
        }); */
    }
}
