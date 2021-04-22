<?php
namespace App\Utils;

use App\Services\MarketService;

class Reportes
{
    public static function getReporteVentas($data)
    {
        // dd($empresas_id, $start_date, $end_date, $bancas_id, $users_id);
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

    public static function getReporteResultados($empresas_id, $start_date, $end_date, $loterias_id = null)
    {
        // dd($empresas_id, $start_date, $end_date, $bancas_id, $users_id);
        $marketService = resolve(MarketService::class);
        $data =  $marketService->getReporteResultados($empresas_id, $start_date, $end_date, $loterias_id);

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
    public static function getreporteVentasDetalle($empresas_id, $start_date, $end_date, $loterias_id, $bancas_id = null, $users_id = null)
    {
        // dd($empresas_id, $start_date, $end_date, $loterias_id);
        $marketService = resolve(MarketService::class);
        $data =  $marketService->getreporteVentasDetalle($empresas_id, $start_date, $end_date, $loterias_id, $bancas_id, $users_id);

        return $data;
    }

    public static function getreporteResultadosDetalle($empresas_id, $start_date, $end_date, $loterias_id)
    {
        // dd($empresas_id, $start_date, $end_date, $loterias_id);
        $marketService = resolve(MarketService::class);
        $data =  $marketService->getreporteResultadosDetalle($empresas_id, $start_date, $end_date, $loterias_id);

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
        // dd($empresas_id, $start_date, $end_date, $bancas_id, $users_id);
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
    public static function getResultadosFecha($empresas_id, $start_date, $end_date)
    {
        // dd($empresas_id, $start_date, $end_date, $bancas_id, $users_id);
        $marketService = resolve(MarketService::class);
        $data =  $marketService->getResultadosFecha($empresas_id, $start_date, $end_date);

        return $data;
    }

    //REULTADOS POR FECHA PARA IMPRIMIR
    public static function getResultadosFechaPrint($empresas_id,  $start_date, $end_date)
    {
        // dd($empresas_id, $start_date, $end_date, $bancas_id, $users_id);
        $marketService = resolve(MarketService::class);
        $data =  $marketService->getResultadosFechaPrint($empresas_id,  $start_date, $end_date);

        return $data;
    }

 //REPORTE DE VENTAS PARA IMPRIMIR
    public static function getReporteVentasPrint($empresas_id, $start_date, $end_date, $bancas_id = null, $users_id = null)
    {
        // dd($empresas_id, $start_date, $end_date, $bancas_id, $users_id);
        $marketService = resolve(MarketService::class);
        $data =  $marketService->getReporteVentasPrint($empresas_id, $start_date, $end_date, $bancas_id, $users_id);

        return $data;
    }

}
