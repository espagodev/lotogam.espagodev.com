<?php

namespace App\Utils;

use App\Services\MarketService;
use Carbon\Carbon;

class CajaRegistradoraUtil
{
    /**
     * Devuelve el número de cajas registradoras abiertas para el
     * usuario que ha iniciado sesión actualmente
     *
     * @return int
     */
    public static function totalCajasAbiertas()
    {
        $marketService = resolve(MarketService::class);

        $users_id = session()->get('user.id');

        $data = $marketService->getTotalCajasAbiertas($users_id);

        return $data;
    }

    public static function getCajaRegistradoraDetalles($users_id, $close_time){

    }

}
