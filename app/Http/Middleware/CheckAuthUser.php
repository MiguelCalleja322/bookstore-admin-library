<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckAuthUser
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
        $authUser = Auth::user();

        if(! $authUser) {
            return redirect('/');
        }

        if ($authUser && $authUser->userRole->role->name == 'admin') {
            return redirect()->route('admin.book.index');
        } else {
            return redirect()->route('user.book.index');
        }

        return $next($request);
    }
}
