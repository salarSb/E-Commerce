<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckUserProfile
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();
        if (!empty($user->email) && empty($user->mobile) && empty($user->email_verified_at)) {
            return redirect()->route('customer.sales-process.profile-completion.index');
        }
        if (empty($user->first_name) || empty($user->last_name) || empty($user->national_code)) {
            return redirect()->route('customer.sales-process.profile-completion.index');
        }
        if (!empty($user->mobile) && empty($user->email) && empty($user->mobile_verified_at)) {
            return redirect()->route('customer.sales-process.profile-completion.index');
        }
        return $next($request);
    }
}
