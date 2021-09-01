<?php

namespace App\Utils;

use App\Services\MarketService;


class FormatoTrasladoUtil
{
    public static function htmlContent($receipt) {

        $output['html_content'] = view('trasladoNumeros.receipts.reporte', compact('receipt'))->render();

        return $output;
    }
}