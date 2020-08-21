<?php

namespace App\Auth;

use App\Models\Athlete;
use Illuminate\Auth\EloquentUserProvider;

class AthleteProvider extends EloquentUserProvider
{
    use UserProviders;

    public static function userOrNull($user){
        return $user && $user->containsType(Athlete::class) ? $user : null;
    }
}