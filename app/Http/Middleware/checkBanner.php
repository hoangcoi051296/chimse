<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class checkBanner
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
            $customer = Auth::guard('customer')->user();
        if (Auth::guard('customer')->check() && $customer->banned_until && now()->lessThan($customer->banned_until)) {
            $banned_days = now()->diffInDays($customer->banned_until);
            auth()->logout();

            if ($banned_days > 14) {
                $message = 'Tài khoản của bạn bị khoá , vui lòng liên hệ với ADMIN.';
            } else {
                $message = 'Tài khoản của bạn đã bị tạm ngưng trong '.$banned_days.' '.Str::plural('Ngày', $banned_days).'. Vui long liên hệ với ADMIN.';
            }

            return redirect()->route('login')->withMessage($message);
        }

        return $next($request);
    }
}
