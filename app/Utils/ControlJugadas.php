<?php

namespace App\Utils;

use App\Services\MarketService;
use Carbon\Carbon;

class ControlJugadas
{
    public static function ConsultaJugadas($numeros, $loteria)
    {
        $marketService = resolve(MarketService::class);

        $data['cnj_fecha'] = date(Carbon::parse());
        $data['loterias_id'] = $loteria;
        $data['users_id'] =   session()->get('user.id');
        $data['empresas_id'] = session()->get('user.emp_id');

        foreach ($numeros as $numero) {

            $data['apt_apuesta'] = $numero->apt_apuesta;

            $control= $marketService->getConsultaControlJugada($data);

            if (!empty($control)) {
                self::updateControlNumero($numero, $control);
            } else {
                self::createControlNumero($numero, $loteria);
            }
        }

        return $control;
    }


    public static function createControlNumero($numero, $loteria)
    {
        $empresas_id = session()->get('user.emp_id');
        $marketService = resolve(MarketService::class);

        $data['users_id']  = $numero->users_id;
        $data['bancas_id']  = $numero->bancas_id;
        $data['modalidades_id']  = $numero->modalidades_id;
        $data['loterias_id']  = $loteria;
        $data['empresas_id']  = $empresas_id;
        $data['cnj_numero']  = $numero->apt_apuesta;
        $data['cnj_contador']  = $numero->apt_valor;
        $data['cnj_fecha']  = date(session()->get('business.date_format'));

        $data = $marketService->nuevoControlJugadas($data);
    }

    public static function updateControlNumero($numero,  $consultaNumero)
    {
        $marketService = resolve(MarketService::class);

        $total = $consultaNumero->cnj_contador + $numero->apt_valor;

        $data = ['cnj_contador' => $total];

        $data = $marketService->actualizarControlJugadas($consultaNumero->id, $data);

    }


}
