<?php

namespace App\Http\Middleware;

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
    public function handle($request, Closure $next, $guard = null) //eto yung lalandingan
    { //pag nag login ulit siya
        if (Auth::guard($guard)->check()) {
            $userRole = Auth::User()->role->role;
            return redirect("/{$userRole}-home");
        }

        return $next($request);
    }
}
