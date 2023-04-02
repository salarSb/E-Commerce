<?php

namespace App\Http\Middleware;

use App\Models\User\Permission;
use Closure;
use Illuminate\Http\Request;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$names)
    {
        if ($request->user()->hasRole('super_admin')) return $next($request);
        foreach ($names as $name) {
            if (
                Permission::status(1)->get()->contains('name', $name) &&
                !$request->user()->can($name)
            ) {
                abort(403);
            } elseif (
                \App\Models\User\Role::status(1)->get()->contains('name', $name) &&
                !$request->user()->hasRole($name)
            ) {
                abort(403);
            }
        }
        return $next($request);
    }
}
