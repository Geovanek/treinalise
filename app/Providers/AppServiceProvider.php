<?php

namespace App\Providers;

use Code\Validator\Cpf;
use Code\Validator\Cnpjf;
use Illuminate\Pagination\Paginator;
use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment() !== 'production') {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \Schema::defaultStringLength(191);
        \Validator::extend('cpf', function($attribute, $value, $parameters, $validator) {
            return (new Cpf())->isValid($value);
        });

        \Validator::extend('cnpj', function ($attibute, $value, $parameters, $validator) {
            return (new Cnpj())->isValid($value); //Para validar CNPJ.
        });

        \DB::listen(function(QueryExecuted $query){
            \Log::info($query->sql);
            \Log::info($query->bindings);
        });

        \Tenant::bluePrintMacros();

        Paginator::useBootstrap();
    }
}
