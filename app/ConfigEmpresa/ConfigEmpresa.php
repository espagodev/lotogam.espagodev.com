<?php

# Ubicacion app\ConfigEmpresa\ConfigEmpresa.php

namespace App\ConfigEmpresa;

use App\Services\MarketService;
use DateTimeZone;

class ConfigEmpresa{


    //configuracion de la empresa
    public static function codigoEmpresa()
    {
        $marketService = resolve(MarketService::class);
        $data = $marketService->getAppConfigEmpresas();

        $incrementoEmpresa = $data->empresaInicial;
        $dijitosEmpresa = $data->dijitosEmpresa;

        $Empresa =  $data->ultimaEmpresa + $incrementoEmpresa;

        $EmpresaModificada = $data->prefijoEmpresa ." ". str_pad($Empresa,  $dijitosEmpresa, "0", STR_PAD_LEFT);
        return $EmpresaModificada;
    }

    //zona Horari

    public static function zonaHoraria()
    {
        $timezones = DateTimeZone::listIdentifiers(DateTimeZone::ALL);

        $timezone_list = [];
        foreach ($timezones as $timezone) {
            $timezone_list[$timezone] = $timezone;
        }

         return $timezone_list;
    }

     /**
     * Retorna formato de fechas
     */
    public static function formatoFecha()
    {
        return [
            'd-m-Y' => 'dd-mm-yyyy',
            'm-d-Y' => 'mm-dd-yyyy',
            'd/m/Y' => 'dd/mm/yyyy',
            'm/d/Y' => 'mm/dd/yyyy'
        ];

        // ,
        //     'd/m/Y' => 'dd/mm/yyyy',
        //     'm/d/Y' => 'mm/dd/yyyy'
    }

     /**
     * Retorna formato de horas
     */
    public static function formatoHora()
    {
        return [
            12 => '12 Horas',
            24 => '24 Horas'

        ];
    }

     /**
     * Retorna Ubicacion simbolo moneda
     */
    public static function ubicacionSimboloMoneda()
    {
        return [
            'before' => 'Antes de la Cantidad',
            'after' => 'Después de la Cantidad'
        ];
    }

    /**
     * Retorna Tipo de Iempresora
     */
    public static function tipoImpresora()
    {
        return [
            'printer' => 'Usar impresora de recibos configurada',
            'browser' => 'Impresión basada en navegador'
        ];
    }

    /**
     * Impresion Automatica
     */
    public static function impresionAutomatica()
    {
        return [
            '1' => 'SI',
            '0' => 'NO'
        ];
    }

}

