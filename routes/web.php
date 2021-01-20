<?php

use App\Http\Controllers\Admin\CompanyProfileController;
use App\Http\Controllers\Admin\PlanController;
use App\Http\Controllers\Admin\PlanDetailController;
use App\Http\Controllers\Admin\PlanCompanyController;
use App\Http\Controllers\Admin\PlanExtensionController;
use App\Http\Controllers\App\Athlete\AthleteController;
use App\Http\Controllers\App\Company\CoachAthleteController;
use App\Http\Controllers\App\Company\CompanyAthleteController;
use App\Http\Controllers\App\Company\CompanyController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Front\HomeController;
use Illuminate\Support\Facades\Route;


Auth::routes();

Route::get('/login/{provider}', [LoginController::class, 'redirectProvider'])->name('social.login');
Route::get('/login/{provider}/callback', [LoginController::class, 'handleProviderCallback'])->name('social.callback');

Route::group(['prefix' => 'app'], function(){
    Route::group(['middleware' => ['auth:coach_web', 'tenant', 'bindings'], 'prefix' => 'company'], function(){
        Route::get('/dashboard', [CompanyController::class, 'index'])->name('dashboard');

        Route::put('/athletes/unlink/{athlete}', [CompanyAthleteController::class ,'unlink'])->name('athletes.unlink');
        Route::resource('athletes', CompanyAthleteController::class)->only([
            'index', 'show', 'edit', 'update'
        ]);

        Route::resource('coach', CoachAthleteController::class)->only([
            'index', 'show', 'edit', 'update'
        ]);
    });

    Route::group(['middleware' => ['auth:athlete_web', 'bindings'], 'prefix' => 'athlete'], function(){
        Route::get('/home', [AthleteController::class ,'index'])->name('athlete.home');
    });
});


Route::group(['prefix' => 'admin'], function(){
    Route::group(['middleware' => ['auth:admin_web', 'bindings']], function(){
        Route::view('/dashboard', 'admin.dashboard')->name('admin.dashboard');
        //Route::get('/dashboard', 'AdminController@index')->name('dashboard');

        /** Plans Routes */
        Route::get('plan/{id}/extensions', [PlanExtensionController::class, 'index'])->name('plans.extensions');
        Route::get('plan/{id}/companies', [PlanCompanyController::class, 'index'])->name('plans.companies');
        Route::resource('plan/{id}/details', PlanDetailController::class)->except([
            'show'
        ]);
        Route::resource('plans', PlanController::class)->except([
            'show'
        ]);

        /** Users Routes */
        Route::group(['prefix' => 'users'], function(){
            Route::view('/{id}/profile', 'admin.users.profile')->name('users.profile');
            Route::view('/', 'admin.users.index')->name('users.index');
        });

        /** Athletes Routes */
        Route::group(['prefix' => 'athletes'], function(){
            Route::view('/{uuid}/profile', 'admin.athletes.profile')->name('athletes.profile');
            Route::view('/', 'admin.athletes.index')->name('athletes.index');
        });

        /** Companies Routes */
        Route::group(['prefix' => 'companies'], function(){
            //Route::view('/{id}/companies', 'admin.companies.companies')->name('companies.companies');
            //Route::view('/{url}/plans', 'admin.companies.plans')->name('companies.plans');
            Route::get('/{slug}/profile', [CompanyProfileController::class, 'index'])->name('companies.profile');
            Route::view('/', 'admin.companies.index')->name('companies.index');
        });
        
        /** Extensions Routes */
        Route::group(['prefix' => 'extensions'], function(){
            Route::view('/{id}/companies', 'admin.extensions.companies')->name('extensions.companies');
            Route::view('/{slug}/plans', 'admin.extensions.plans')->name('extensions.plans');
            Route::view('/{slug}/details', 'admin.extensions.details')->name('extensions.details');
            Route::view('/', 'admin.extensions.index')->name('extensions.index');
        });

        /** Another Routes */
        Route::view('/icons', 'admin.icons')->name('admin.icons');
    });
});

/**
 * Frontend Routes
 */
Route::get('/subscription/plan/{uuid}', [HomeController::class, 'subscriptionPlan'])->name('subscription.plan');
Route::get('/', [HomeController::class, 'index'])->name('index');


Route::fallback(function() {
    return 'Ué, por que você veio parar aqui?';
});