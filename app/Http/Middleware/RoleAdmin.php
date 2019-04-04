<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class RoleAdmin
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
        if(Auth::user()->akses !="admin"){
            return redirect('home');
        }
        return $next($request);
    }
}
