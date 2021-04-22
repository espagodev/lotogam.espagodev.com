<?php

namespace App\Http\Middleware;

use App\Services\MarketService;
use Closure;

class IsAdministrador
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $permiso)
    {
        dd($request->user());
        $marketService = resolve(MarketService::class);
        $userPermission = $marketService->getUserPermission();

        if(!$request->user()->can($permiso)){
            return response()->json(['error'=>'Unauthorised'], 401);
        }

        return $next($request);
    }

    // public function handle($request, Closure $next)
    // {
    //     if (!Auth::user()->hasRole('Administrador')) {
    //         return response()->json(['error' => 'Unauthorised'], 401);
    //     }

    //     return $next($request);
    // }
}
