<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class accesAdmin
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
        if(Auth::user()->role_id == 1){
            return $next($request);
        } else {
            return redirect('/home');
        }
    }
}
