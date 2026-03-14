<?php

namespace App\Http\Middleware;

use Closure;

class CustomAuthMiddleware
{
    public function handle($request, Closure $next)
    {
        
        if (!session()->has('user_id')) {
            return redirect('/login')->with('error', 'you need to log in to access this page');
        }
        
        return $next($request);
    }
}