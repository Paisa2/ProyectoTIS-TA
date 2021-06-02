<?php

namespace App\Http\Middleware;

use Closure;

class RegisterUnidad
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
        // if (session()->nombre_rol==='') {
        //     # code...
        //     return $next($request);
        // }
        // return redirect('/');
    }
}
