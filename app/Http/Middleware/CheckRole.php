<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
public function handle(Request $request, Closure $next, ...$roles)
{
    // Vérifier si l'utilisateur a un des rôles spécifiés
    if (Auth::check() && in_array(Auth::user()->role, $roles)) {
        return $next($request);
    }

    // Rediriger ou refuser l'accès si l'utilisateur n'a pas le bon rôle
    abort(403, 'Accès refusé');
}

}
