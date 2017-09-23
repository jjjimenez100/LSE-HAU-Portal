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
            abort(403, "Forbidden");
        }
        else{
            $userRole = Auth::User()->role->role;
            if($role == "head"){
                if($userRole == "User"){
                    abort(403, "not allowed beybe! :)");
                }
            }

            else if($role == "user"){
                if($userRole != "User"){
                    abort(403, "not allowed beybe! :)");
                }
            }

            return $next($request);
        }
    }
}
