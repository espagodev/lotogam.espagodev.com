<?php

namespace App\Utils;

use App\Services\MarketService;

class Tickets
{

    public static function ticketAgrupado($tickets)
    {        
        $output['tickets'] =  self::encabezadoAgrupado($tickets);
        $output['detalleTicket'] =  self::detalleAgrupado($tickets[0]);
        $output['ajustes'] =  self::ajustesAgrupado($tickets[0]);
        $output['total'] =  self::totalAgrupado($tickets);

        return $output;
    }

    static function encabezadoAgrupado($tickets)
    {
        $marketService = resolve(MarketService::class);

        foreach ($tickets as $ticket) {
            $datos = $marketService->getTicket($ticket);
            $data[] = ['tic_ticket' => $datos[0]->tic_ticket, 'tic_pin' => $datos[0]->tic_pin, 'lot_nombre' => $datos[0]->lot_nombre];
        }

        return $data;
    }

    static function detalleAgrupado($ticket)
    {
        $marketService = resolve(MarketService::class);

            $data = $marketService->getTicketDetalle($ticket);

        return $data;
    }

    static function ajustesAgrupado($ticket)
    {
        $marketService = resolve(MarketService::class);

        $datos = $marketService->getTicket($ticket);
        $data = ['tic_promocion' => $datos[0]->tic_promocion, 'tic_sorteo_futuro' => $datos[0]->tic_sorteo_futuro, 'created_at' => $datos[0]->created_at, 'tic_fecha_sorteo' => $datos[0]->tic_fecha_sorteo];
        return $data;
    }

    static function totalAgrupado($tickets)
    {
        $marketService = resolve(MarketService::class);
        $TotalPremios = 0;
        foreach ($tickets as $ticket) {
            $datos = $marketService->getTicket($ticket);
            $TotalPremios = $TotalPremios + $datos[0]->tic_apostado;

        }

        return $data = ['tic_apostado' => $TotalPremios];
    }
}
