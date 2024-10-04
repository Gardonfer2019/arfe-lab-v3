<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckIfSuperAdmin
{
    public function handle($request, Closure $next)
    {
        // Verifica si el usuario tiene el rol super_admin
        if (Auth::check() && Auth::user()->hasRole('super_admin')) {
            return $next($request);
        }

        // Si no tiene el rol, redirigir o mostrar un error 403
        return redirect()->route('home')->withErrors('No tienes acceso a esta área.');
    }
}