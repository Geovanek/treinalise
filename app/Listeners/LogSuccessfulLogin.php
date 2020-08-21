<?php

namespace App\Listeners;

use App\Models\Admin;
use App\Models\Athlete;
use App\Models\Coach;
use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogSuccessfulLogin
{
    /**
     * Handle the event.
     *
     * @param  Login  $event
     * @return void
     */
    public function handle(Login $event)
    {
        if ($event->user->containsType(Admin::class)){
            $guard = 'admin_web';
        } else if ($event->user->containsType(Coach::class)){
            $guard = 'coach_web';
        } else if ($event->user->containsType(Athlete::class)){
            $guard = 'athlete_web';
        } else {
            $guard = 'athlete_web';;
        }
        
        return $guard;
    }
}
