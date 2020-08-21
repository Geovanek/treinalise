<?php

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

$domain = parse_url(config('app.url'))['host'];

Route::domain("$domain")
->group(function(){

    Route::get('/', function () {
        return view('welcome');
    });

    Auth::routes();

    Route::get('/home', 'HomeController@index')->name('home');

    Route::post('/login/social', 'Auth\LoginController@socialRedirect');
    Route::get('/login/callback', 'Auth\LoginController@socialCallback');

    Route::group(['namespace' => 'App', 'prefix' => 'app'], function(){
        Route::group(['middleware' => ['auth:coach_web', 'tenant', 'bindings'], 'namespace' => 'Company', 'prefix' => 'company'], function(){
            Route::get('/dashboard', 'CompanyController@index')->name('dashboard');

            Route::put('/athletes/unlink/{athlete}', 'CompanyAthleteController@unlink')->name('athletes.unlink');
            Route::resource('athletes', 'CompanyAthleteController')->only([
                'index', 'show', 'edit', 'update'
            ]);

            Route::resource('coach', 'CoachAthleteController')->only([
                'index', 'show', 'edit', 'update'
            ]);
        });

        Route::group(['middleware' => ['auth:athlete_web', 'bindings'], 'namespace' => 'Athlete', 'prefix' => 'athlete'], function(){
            Route::get('/home', 'AthleteController@index')->name('home');
        });
    });


    Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function(){
        Route::group(['middleware' => ['auth:admin_web', 'bindings']], function(){
            Route::get('/dashboard', function(){
                return view('admin.dashboard');
            });
            //Route::get('/dashboard', 'AdminController@index')->name('dashboard');
        });
    });
    
});

Route::domain('admin.'. "$domain")
->group(function(){

    Route::get('/home', function(){
        return view('admin.dashboard');
    });
    
});
