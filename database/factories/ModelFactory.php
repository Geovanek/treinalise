<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Models\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => 'password', // $2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi // password
        'remember_token' => Str::random(10),
        'phone' => $faker->phoneNumber,
        'cpf' => Str::random(11)
    ];
});

/* $factory->state(\App\Models\User::class, 'head_coach', function($faker){
    return [
        'role' => \App\Models\Coach::ROLE_HEAD_COACH
    ];
});
$factory->state(\App\Models\Coach::class, 'coach', function($faker){
    return [
        'role' => \App\Models\Coach::ROLE_COACH
    ];
}); */
