<?php

namespace App\Http\Middleware;

use Closure;
use App\Http\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //User role is admin
        if ( Auth::check() && Auth::user()->isAdmin() )
        {
            return view('userHome');
        }

        //If user role is student
        if(Auth::check() && auth()->user()->role === 'employee')
        {
             return view('userHome');
        }
        return $next($request);
    }
}
