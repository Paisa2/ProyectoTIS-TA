<?php

namespace App\Http\Middleware;

use Closure;

class TienePermisoVisualizarSolicitudesItems
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
        if (!session()->has('Visualizar solicitud de ítems')) {
            abort(403);
        }
        return $next($request);
    }
}
