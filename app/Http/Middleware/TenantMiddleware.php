<?php

namespace App\Http\Middleware;

use Closure;

class TenantMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = \Auth::user();
        // $tenantObj = $user->userable->tenant;
        //dd($user);
        //na linha abaixo o método coach é o userTenant lá no curso
        $tenantObj = $user->coach->tenant;
        \Tenant::setTenant($tenantObj);
        return $next($request);
    }
}
