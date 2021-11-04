<?php

namespace App\Utils;

use App\Services\MarketService;

class TicketAgrupado
{

    public static function ticketAgrupado($tickets)
    {        
        $output['tickets'] =  self::encabezadoAgrupado($tickets);
        $output['detalleTicket'] =  self::detalleAgrupado($tickets[0]->id);
        $output['ajustes'] =  self::ajustesAgrupado($tickets[0]);
        $output['total'] =  self::totalAgrupado($tickets);

        return $output;
    }

    static function encabezadoAgrupado($tickets)
    {
        
        foreach ($tickets as $ticket) {          
            $data[] = ['tic_ticket' => $ticket->tic_ticket, 'tic_pin' => $ticket->tic_pin, 'lot_nombre' => $ticket->lot_nombre];
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
        $data = ['tic_promocion' => $ticket->tic_promocion, 'tic_sorteo_futuro' => $ticket->tic_sorteo_futuro, 'created_at' => $ticket->created_at, 'tic_fecha_sorteo' => $ticket->tic_fecha_sorteo];
        return $data;
    }

    static function totalAgrupado($tickets)
    {       
        $TotalPremios = 0;
        foreach ($tickets as $ticket) {
            $TotalPremios = $TotalPremios + $ticket->tic_apostado;
        }

        return $data = ['tic_apostado' => $TotalPremios];
    }
}
