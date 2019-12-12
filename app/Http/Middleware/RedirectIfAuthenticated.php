<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check() && $guard == 'customer') {
            return redirect('/customer/tickets');
        }

        if (Auth::guard($guard)->check() && $guard == 'agent') {
            return redirect('/agent/dashboard');
        }

        return $next($request);
    }
}
