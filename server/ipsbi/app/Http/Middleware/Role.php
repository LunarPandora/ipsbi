<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if(Auth::check()){
            if(Auth::user()->role == $role){
                return $next($request);
            }
            else{
                return response('ACCESS_DENIED.', 419);
            }
        }
        else{
            return response('NOT_AUTHENTICATED.', 419);
        }
    }
}
