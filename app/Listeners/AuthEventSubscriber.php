<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use App\Listeners\LogSuccessfulLogin;

class AuthEventSubscriber
{
    public function onLogin(Login $event)
    {
        $logGuard= new LogSuccessfulLogin;
        $userGuard = $logGuard->handle($event);

        if (\SectionGuard::hasGuardLogged($userGuard) ||
            !\SectionGuard::hasAuthGuard($userGuard)) {
            return;
        }

        $guards = \SectionGuard::exceptGuard($userGuard);

        foreach ($guards as $guard) {
            $provider = \Auth::guard($guard)->getProvider();
            $providerClass = get_class($provider);
            if ($providerClass::userOrNull($event->user)) {
                \SectionGuard::addGuardLogged($guard);
                \Auth::guard($guard)->login($event->user);
            }
        }
    }

    public function onLogout(Logout $event)
    {
        if (\SectionGuard::hasGuardLoggedOut($event->guard) ||
            !\SectionGuard::hasAuthGuard($event->guard)) {
            return;
        }

        $guards = \SectionGuard::exceptGuard($event->guard);
        foreach ($guards as $guard) {
            if (\Auth::guard($event->guard)->check()) {
                \SectionGuard::addGuardLoggedOut($guard);
                \Auth::guard($guard)->logout();
            }
        }
    }

    public function subscribe($events)
    {
        $events->listen(
            Login::class,
            '\App\Listeners\AuthEventSubscriber@onLogin'
        );

        $events->listen(
            Logout::class,
            '\App\Listeners\AuthEventSubscriber@onLogout'
        );
    }
}