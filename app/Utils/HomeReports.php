<?php

namespace App\Utils;

use App\Services\MarketService;
class HomeReports
{
    /**
     * Da el monto total de la compra de una empresa dentro del rango de fechas transcurrido
     *
     * @param int $empresas_id
     * @param int $transaction_id
     *
     * @return array
     */

    public function getPurchaseTotals($data)
    {
        // $data = json_encode(['empresas_id'=> $empresas_id, 'start_date' => $start_date, 'end_date' => $end_date, 'bancas_id' => $bancas_id, 'user_id' => $user_id]);

        $marketService = resolve(MarketService::class);
        $data =  $marketService->getHomereportes($data);

        return $data;
    }


}
