<?php

# Ubicacion app\ConfigFacturas\ConfigFacturas.php

namespace App\ConfigFacturas;

use App\Services\MarketService;

class ConfigFacturas{



    //configuracion de la empresa
    public static function codigoFactura()
    {
        $marketService = resolve(MarketService::class);

        $data = $marketService->getAppConfigFacturas();

        $incrementoFactura = $data->facturaIncremento;

        $dijitosFactura = $data->dijitosFactura;

        $factura =  $data->ultimaFactura + $incrementoFactura;

        $facturaModificada = $data->prefijoFactura ." ". str_pad($factura,  $dijitosFactura, "0", STR_PAD_LEFT);
        return $facturaModificada;
    }


    public static function descuento()
    {
        $marketService = resolve(MarketService::class);
        $data = $marketService->getAppConfigFacturas();

        $descuento = explode(",", str_replace(" ", "", ($data->descuentos)));

        $descuento_lista = array_combine($descuento, $descuento);

        return  $descuento_lista;
    }

    public static function impuesto()
    {
        $marketService = resolve(MarketService::class);
        $data = $marketService->getAppConfigFacturas();

        $impuesto = $data->impuestos;

        return  $impuesto;
    }

}
