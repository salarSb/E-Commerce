<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckUserProfile
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();
        if (
            empty($user->mobile) ||
            empty($user->first_name) ||
            empty($user->last_name) ||
            empty($user->email) ||
            empty($user->national_code)
        ) {
            return redirect()->route('customer.sales-process.profile-completion.index');
        }
        return $next($request);
    }
}
