<?php

namespace App\Http\Middleware;

use Closure;

class TienePermisoCrearSolicitudItem
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
        if (!session()->has('Crear solicitud de items')) {
            abort(403);
        }
        return $next($request);
    }
}
