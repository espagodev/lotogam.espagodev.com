<?php

namespace App\Http\Middleware;


use Closure;
use Illuminate\Support\Facades\Auth;
use App\Services\MarketService;
use App\Utils\Util;

class SetSessionData
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

        if (!$request->session()->has('user')) {

        $marketService = resolve(MarketService::class);

        $user = $marketService->getUserInformation();
           
        $util = new Util;


        $session_data = [
            'id' => $user->identificador,
            'surname' => $user->nombre,
            'email' => $user->email,
            'emp_id' => $user->idEmpresa,
            'TipoUsuario' => $user->tipoUsuario,
            'banca' => $user->idBanca,
            'resultados' => $user->resultado,
            'bancaBloqueo' => $user->bancaBloqueo,
            'userHoraro' => $user->userHoraro,
        ];

        if ($user->tipoUsuario != 1) {
            $empresa = $marketService->getEmpresaDetalle($user->idEmpresa);
            $moneda = $marketService->getEmpresaMoneda($user->idEmpresa);
            $banca = $marketService->getBanca($user->idBanca);

            $empresa_data = [
                'date_format' => $empresa->emp_formato_fecha,
                'time_zone ' => $empresa->emp_zona_horaria,
                'logo ' => $empresa->emp_imagen,

            ];

            $currency_data = [
                'id' => $moneda->id,
                'code' => $moneda->codigo,
                'symbol' => $moneda->simbolo,
                'thousand_separator' => $moneda->separador_miles,
                'decimal_separator' => $moneda->separador_decimal
            ];

            $banca_data = [
                'limite_venta' => isset($banca->ban_limite_venta) ? $banca->ban_limite_venta : '0'
            ];

            $request->session()->put('business', $empresa_data);
            $request->session()->put('currency', $currency_data);
            $request->session()->put('banca', $banca_data);
        }
        $request->session()->put('user', $session_data);

        //set current financial year to session
        $financial_year = $util->getCurrentFinancialYear();
        $request->session()->put('financial_year', $financial_year);
        // }
        }
        return $next($request);
    }
}
