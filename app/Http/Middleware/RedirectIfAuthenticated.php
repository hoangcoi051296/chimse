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
        switch ($guard) {
            case 'manager':
                if (Auth::guard($guard)->check()) {
                    return redirect()->route('manager.index');
                }
                break;
//            case 'customer':
//                if (Auth::guard($guard)->check()) {
//                    return redirect()->route('customer.index');
//                }
//                break;
            case 'employee':
                if (Auth::guard($guard)->check()) {
                    return redirect()->route('employee.index');
                }
                break;
        }
        return $next($request);
    }
}
