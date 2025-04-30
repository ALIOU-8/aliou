<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class TpuMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
       // Vérifiez si l'utilisateur est authentifié et a le rôle d'tpu ou admin
       if (Auth::check() && (Auth::user()->droit === 'admin' || Auth::user()->droit === 'tpu')) {
        return $next($request);  // L'utilisateur est tpu ou admin, laissez-le passer
    }

    // Rediriger ou afficher un message d'erreur si l'utilisateur n'est pas tpu ou admin
    return  to_route('erreur');
    }
}
