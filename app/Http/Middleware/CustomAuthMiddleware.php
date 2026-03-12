<?php

namespace App\Http\Middleware;

use Closure;

class CustomAuthMiddleware
{
    public function handle($request, Closure $next)
    {
        // Vérification simple si l'utilisateur est connecté via la session
        if (!session()->has('user_id')) {
            return redirect('/login')->with('error', 'Vous devez être connecté pour accéder à cette page');
        }
        
        return $next($request);
    }
}