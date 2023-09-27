<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRoleMiddleware
{

    public function handle($request, Closure $next, $role = null)
    {
        $authUser = Auth::user();

        if(! $authUser) {
            return redirect('/');
        }

        if ($role != $authUser->userRole->role->name) {
            return abort(403);
        }

        return $next($request);
    }
}
