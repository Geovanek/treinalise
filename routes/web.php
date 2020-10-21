<?php

use App\Http\Controllers\Admin\PlanController;
use App\Http\Controllers\Admin\PlanDetailController;
use App\Http\Controllers\App\Athlete\AthleteController;
use App\Http\Controllers\App\Company\CoachAthleteController;
use App\Http\Controllers\App\Company\CompanyAthleteController;
use App\Http\Controllers\App\Company\CompanyController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Livewire\Admin\Extensions\ExtensionDetails;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function(){
    return view('home');
})->name('home');

Auth::routes();

Route::get('/login/{provider}', [LoginController::class, 'redirectProvider'])->name('social.login');
Route::get('/login/{provider}/callback', [LoginController::class, 'handleProviderCallback'])->name('social.callback');

Route::group(['prefix' => 'app'], function(){
    Route::group(['middleware' => ['auth:coach_web', 'tenant', 'bindings'], 'namespace' => 'Company', 'prefix' => 'company'], function(){
        Route::get('/dashboard', [CompanyController::class, 'index'])->name('dashboard');

        Route::put('/athletes/unlink/{athlete}', [CompanyAthleteController::class ,'unlink'])->name('athletes.unlink');
        Route::resource('athletes', CompanyAthleteController::class)->only([
            'index', 'show', 'edit', 'update'
        ]);

        Route::resource('coach', CoachAthleteController::class)->only([
            'index', 'show', 'edit', 'update'
        ]);
    });

    Route::group(['middleware' => ['auth:athlete_web', 'bindings'], 'namespace' => 'Athlete', 'prefix' => 'athlete'], function(){
        Route::get('/home', [AthleteController::class ,'index'])->name('athlete.home');
    });
});


Route::group(['prefix' => 'admin'], function(){
    Route::group(['middleware' => ['auth:admin_web', 'bindings']], function(){
        Route::resource('plans', PlanController::class)->except([
            'show'
        ]);
        Route::resource('plan/{url}/details', PlanDetailController::class);
        Route::view('/dashboard', 'admin.dashboard')->name('admin.dashboard');
        Route::view('/icons', 'admin.icons')->name('admin.icons');
        //Route::get('/dashboard', 'AdminController@index')->name('dashboard');

        Route::view('/extensions', 'admin.extensions.index')->name('extensions.index');
        Route::view('/extensions/{url}/details', 'admin.extensions.details')->name('extensions.details');
    });
});

Route::fallback(function() {
    return 'Hm, why did you land here somehow?';
});