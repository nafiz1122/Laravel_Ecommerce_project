<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
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
        if (Auth::guard($guard)->check()) {

            if(Auth::user()->role_type == 'admin'){
                return redirect("/dashboard");
            }
            else if(Auth::user()->role_type == 'customer'){
                return redirect("/customer-dashboard");
            }

        }

        return $next($request);
    }
}
