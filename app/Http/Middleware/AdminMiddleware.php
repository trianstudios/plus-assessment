<?php

namespace App\Http\Middleware;

use App\Helpers\RolePermission;
use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(!auth()->check()){
            abort(401);
        }

        if(!in_array(RolePermission::ADMIN_ROLE, auth()->user()->roles->pluck('name')->toArray(), true)){
            return back();
        }

        return $next($request);
    }
}
