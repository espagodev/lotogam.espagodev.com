<?php

namespace App\Utils;

use App\Services\MarketService;
use Carbon\Carbon;

class ControlJugadas
{
    public static function ConsultaJugadas($numeros, $loteria)
    {
        $marketService = resolve(MarketService::class);
        $users_id = request()->session()->get('user.id');
        $fecha =  date(Carbon::parse());
        foreach ($numeros as $numero) {

            $data = $marketService->getConsultaControlJugada($users_id, $numero->apt_apuesta, $loteria, $fecha);

            if (!empty($data)) {
                // No está vacía (true)
                // dd('hay algo vamos por aqui');
               self::updateControlNumero($numero, $data);
            } else {
                // Está vacía (false)
                // dd('no hay nada vamos por aqui');
              self::createControlNumero($numero, $loteria);
            }
        }

        return $data;
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

        // dd($numeros);
        // if ($consultaNumero['cnj_numero'] <= $monto) {
        //     $apuestaFaltante = ($monto - $consultaNumero['cnu_contador']);
        //     if ($numeros['apd_valor'] <= $apuestaFaltante) {
        //         $total = $numeros['apd_valor'];
        //         $total = $consultaNumero['cnu_contador'] + $total;
        //     } else {
        //         $total = $apuestaFaltante;
        //         $total = $consultaNumero['cnu_contador'] + $total;
        //     }
        // }

            // dd($consultaNumero->cnj_contador, $numero->apt_valor);
        $total = $consultaNumero->cnj_contador + $numero->apt_valor;

        $data = ['cnj_contador' => $total];

        $data = $marketService->actualizarControlJugadas($consultaNumero->id, $data);



        // $Control = ControlNumeros::where('lot_id', $loteria['lot_id'])
        // ->where([
        //     'cnu_numero' => $numeros['apd_numero'],
        //     'cnu_fecha' => date("Y-m-d"),
        //     'usu_id' => auth()->user()->id
        // ])
        //     ->update(array('cnu_contador' => $total));
    }


}
