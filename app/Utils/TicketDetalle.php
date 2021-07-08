<?php

namespace App\Utils;

use App\Services\MarketService;

class TicketDetalle
{



    public static function GenerarApuesta($request, $numeroOrdenado, $modalidad, $comision)
    {
        $marketService = resolve(MarketService::class);

        $users_id = request()->session()->get('user.id');
        $empresas_id = session()->get('user.emp_id');
        $bancas_id = session()->get('user.banca');

        $data = $request->all();

        $apt_valor = $data['tid_valor'];

        $data = $request->except('_token');

        $data['users_id']  = $users_id;
        $data['bancas_id']  = $bancas_id;
        $data['empresas_id']  = $empresas_id;
        $data['modalidades_id']  = $modalidad;
        $data['apt_apuesta']  = $numeroOrdenado;
        $data['apt_valor']  = $apt_valor;
        $data['apt_numero1'] = substr($numeroOrdenado, 0, 2);
        $data['apt_numero2'] = substr($numeroOrdenado, 2, 2) ? substr($numeroOrdenado, 2, 2) : '';
        $data['apt_numero3'] = substr($numeroOrdenado, 4, 2) ? substr($numeroOrdenado, 4, 2) : '';
        $data['apt_comision'] = Util::get_percent($apt_valor, $comision);


        $data = $marketService->nuevaApuestaTemp($data);

        return $data;
    }

    public static function GenerarApuesta1($request, $numeroOrdenado, $modalidad, $comision)
    {
        $marketService = resolve(MarketService::class);

        $users_id = request()->session()->get('user.id');
        $empresas_id = session()->get('user.emp_id');
        $bancas_id = session()->get('user.banca');

        $data = $request->all();

        $apt_valor = $data['apt_valor'];
        $data = $request->except('_token');

        $data['users_id']  = $users_id;
        $data['bancas_id']  = $bancas_id;
        $data['empresas_id']  = $empresas_id;
        $data['modalidades_id']  = $modalidad;
        $data['apt_apuesta']  = $numeroOrdenado;
        $data['apt_numero1'] = substr($numeroOrdenado, 0, 2);
        $data['apt_numero2'] = substr($numeroOrdenado, 2, 2) ? substr($numeroOrdenado, 2, 2) : '';
        $data['apt_numero3'] = substr($numeroOrdenado, 4, 2) ? substr($numeroOrdenado, 4, 2) : '';
        $data['apt_comision'] = Util::get_percent($apt_valor, $comision);


        $data = $marketService->nuevoTicketDetalleBanca($data);

        return $data;
    }

    public static function DuplicarApuesta($numeros, $loteria, $ticketId){
        $marketService = resolve(MarketService::class);
        // dd($numero, $loteria, $ticketId);

            $empresas_id = session()->get('user.emp_id');

        foreach ($numeros as $numero) {

            $data['tickets_id']  = $ticketId;
            $data['users_id']  = $numero->users_id;
            $data['bancas_id']  = $numero->bancas_id;
            $data['loterias_id']  = $loteria;
            $data['empresas_id']  = $empresas_id;
            $data['modalidades_id']  = $numero->modalidades_id;
            $data['tid_apuesta']  = $numero->apt_apuesta;
            $data['tid_numero1'] = $numero->apt_numero1;
            $data['tid_numero2'] = $numero->apt_numero2;
            $data['tid_numero3'] = $numero->apt_numero3;
            $data['tid_valor'] = $numero->apt_valor;
            $data['tid_comision'] = $numero->apt_comision;
            $data['tid_fecha_sorteo'] = date(session()->get('business.date_format'));


            $marketService->nuevoTicketDetalleBanca($data);
        }

        // return $ticketsDetalles;
    }

    public static function ModificarApuesta($id, $apt_valor, $valor,  $comision)
    {

        $marketService = resolve(MarketService::class);

        $nuevo_valor  = $apt_valor + $valor;
        $nueva_comision = Util::get_percent($nuevo_valor, $comision);


        $data = ['apt_valor' => $nuevo_valor, 'apt_comision' => $nueva_comision];

        $data = $marketService->actualizarApuestaDetalleTemp($id,  $data);

        return $data;
    }

    public static function ModificarApuesta1($tickets_id, $apt_valor, $valor,  $NumeroOrdenado, $comision)
    {
        $marketService = resolve(MarketService::class);

        $nuevo_valor  = $apt_valor + $valor;
        $nueva_comision = Util::get_percent($nuevo_valor, $comision);

        $data = $marketService->actualizarTicketDetalleBanca($tickets_id,  $NumeroOrdenado, $nuevo_valor, $nueva_comision);

        return $data;
    }

    /**
     * Monto individual de Apuesta por Modalidad
     */
    public static function MontoApuestaModalidad($modalidad)
    {
        $marketService = resolve(MarketService::class);

        // $users_id = request()->session()->get('user.id');
        $banca_id = request()->session()->get('user.banca');

        $data = $marketService->getMontoApuestaModalidad($banca_id,  $modalidad);

        if (is_null($data)) {

            return 0;
        } else {
            return $data[0]->mti_valor;
        }
    }

    /**
     * Monto global de Apuesta por Modalidad
     */
    public static function MontoGlobalModalidad($modalidad)
    {
        $marketService = resolve(MarketService::class);
        $banca_id = request()->session()->get('user.banca');

        $data = $marketService->getMontoGlobalApuesta($banca_id,  $modalidad);

        if (is_null($data)) {

            return 0;
        } else {
            return $data[0]->mtg_valor;
        }
    }

    /**
     * Monto de comision por Modalidad
     */
    public static function MontoComisionModalidad($modalidad)
    {
        $marketService = resolve(MarketService::class);

        $banca_id = request()->session()->get('user.banca');

        $data = $marketService->getMontoComisionModalidad($banca_id,  $modalidad);

        if (is_null($data)) {
            return 0;
        } else {
            return $data[0]->com_valor;
        }
    }

}
