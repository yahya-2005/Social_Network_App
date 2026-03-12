<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthMiddleware
{
    
    public function handle(Request $request, Closure $next)
    {
        if(!session()->has('user_id')){
            return redirect('/login')->with('error','you should be connected to access to this page');
        }
        return $next($request);
    }
}
