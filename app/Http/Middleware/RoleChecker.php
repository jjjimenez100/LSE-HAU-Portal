<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class RoleChecker
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        if(!(Auth::check())){
            return redirect("/");
        }
        else{
            $userRole = Auth::User()->role->role;
            if($userRole != $role){
                return redirect("/{$userRole}-home");
            }
            return $next($request);
        }
    }
}
