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

        //TODO: refactor
//        if (Auth::guard($guard)->check()) {
//            switch ($guard) {
//                case 'customer' :
//                    return redirect()->route('customer.tickets.index');
//                    break;
//                case 'agent' :
//                    return redirect()->route('customer.tickets.index');
//                    break;
//                default:
//                    return redirect()->route('home.index');
//                    break;
//            }
//        }


        return $next($request);
    }
}
