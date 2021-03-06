<?php

namespace App\Http\Middleware;

use Closure;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        if (!$request->user()->hasRole($role)) {
            //return redirect('home'); 
            // Aqui editar para mostrar que no tiene permiso mediante una vista error personalizada
            abort(403, "No tienes autorización para ingresar");
        }
        return $next($request);
    }
}
