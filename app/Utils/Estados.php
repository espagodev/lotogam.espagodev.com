<?php
namespace App\Utils;

use App\Services\MarketService;

class Estados
{
    public static function getEstadoTiposDocumeno($tipoDocumento_id, $estado)
    {
        // dd($empresas_id, $start_date, $end_date, $bancas_id, $users_id);
        $marketService = resolve(MarketService::class);
        $data =  $marketService->getEstadoTiposDocumeno($tipoDocumento_id, $estado);

        return $data;
    }
}
