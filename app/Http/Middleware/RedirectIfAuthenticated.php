<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                $user = Auth::user();

                // Redirection conditionnelle selon le rôle
                if ($user->role === 'pharmacie') {
                    return redirect('/pharmacie/dashboard');
                } elseif ($user->role === 'service') {
                    return redirect('/service/dashboard');
                }

             //   return redirect('/dashboard'); // fallback
            }
        }

        return $next($request);
    }
}
