<?php
namespace App\Utils;

use App\Services\MarketService;

class Reportes
{
    public static function getReporteVentas($data)
    {
        // dd($data);
        $marketService = resolve(MarketService::class);
        $data =  $marketService->getReporteVentas($data);

        return $data;
    }

    public static function getReporteTickets($data)
    {

        $marketService = resolve(MarketService::class);
        $data =  $marketService->getReporteTickets($data);

        return $data;
    }

    public static function getReportePremiados($data)
    {
        // dd($empresas_id, $start_date, $end_date, $bancas_id, $users_id);
        $marketService = resolve(MarketService::class);
        $data =  $marketService->getReportePremiados($data);

        return $data;
    }

    public static function getReporteResultados($data)
    {
        // dd($empresas_id, $start_date, $end_date, $bancas_id, $users_id);
        $marketService = resolve(MarketService::class);
        $data =  $marketService->getReporteResultados($data);

        return $data;
    }

    public static function getReporteModalidades($data)
    {
        // dd($empresas_id, $start_date, $end_date, $bancas_id, $users_id);
        $marketService = resolve(MarketService::class);
        $data =  $marketService->getReporteModalidades($data);

        return $data;
    }

    public static function getReporteJugadas($data)
    {
        // dd($empresas_id, $start_date, $end_date, $bancas_id, $users_id);
        $marketService = resolve(MarketService::class);
        $data =  $marketService->getReporteJugadas($data);

        return $data;
    }

    //DETALLES
    public static function getreporteVentasDetalle($data)
    {
        // dd($empresas_id, $start_date, $end_date, $loterias_id);
        $marketService = resolve(MarketService::class);
        $data =  $marketService->getreporteVentasDetalle($data);

        return $data;
    }

    public static function getreporteResultadosDetalle($data)
    {
        // dd($empresas_id, $start_date, $end_date, $loterias_id);
        $marketService = resolve(MarketService::class);
        $data =  $marketService->getreporteResultadosDetalle($data);

        return $data;
    }

    public static function getreporteTicketsDetalle($empresas_id, $start_date, $end_date, $tickets_id)
    {
        // dd($empresas_id, $start_date, $end_date, $loterias_id);
        $marketService = resolve(MarketService::class);
        $data =  $marketService->getreporteTicketsDetalle($empresas_id, $start_date, $end_date, $tickets_id);

        return $data;
    }

    public static function getReporteModalidadesDetalle($data)
    {
        $marketService = resolve(MarketService::class);
        $data =  $marketService->getReporteModalidadesDetalle($data);

        return $data;
    }


    //REPORTE Utilidades
    public static function getloteriasEmpresaReporte($empresas_id)
    {
        // dd($empresas_id, $start_date, $end_date, $bancas_id, $users_id);
        $marketService = resolve(MarketService::class);
        $data =  $marketService->getloteriasEmpresaReporte($empresas_id);

        return $data;
    }

    //REULTADOS POR FECHA
    public static function getResultadosFecha($data)
    {
        // dd($empresas_id, $start_date, $end_date, $bancas_id, $users_id);
        $marketService = resolve(MarketService::class);
        $data =  $marketService->getResultadosFecha($data);

        return $data;
    }

    //REULTADOS POR FECHA PARA IMPRIMIR
    public static function getResultadosFechaPrint($data)
    {
        // dd($empresas_id, $start_date, $end_date, $bancas_id, $users_id);
        $marketService = resolve(MarketService::class);
        $data =  $marketService->getResultadosFechaPrint($data);

        return $data;
    }

 //REPORTE DE VENTAS PARA IMPRIMIR
    public static function getReporteVentasPrint($data)
    {
        // dd($empresas_id, $start_date, $end_date, $bancas_id, $users_id);
        $marketService = resolve(MarketService::class);

        $data =  $marketService->getReporteVentasPrint($data);

        return $data;
    }

}
