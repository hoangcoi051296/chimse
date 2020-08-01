<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class checkLogout
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
        if ( Auth::guard("manager")->check()) {
        return redirect()->route('manager.index');
    }
        if (Auth::guard("customer")->check()) {
            return redirect()->route('customer.index');
        }
        if (Auth::guard("helper")->check()) {
            return redirect()->route('helper.index');
        }
        return $next($request);
    }
}
