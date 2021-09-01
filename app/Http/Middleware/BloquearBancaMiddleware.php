<?php

namespace App\Http\Middleware;

use Closure;

class BloquearBancaMiddleware
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
        if (request()->session()->get('user.bancaBloqueo') == 0)
            return $next($request);
        return redirect('pos')->with('success', ['No puede Realizar Ventas en este Momento Contacte con el Administrador']);;
    }
}
