<?php

namespace App\Utils;

use App\Services\MarketService;

class Montos
{

    public static function ValidarMonto($parametrosBanca, $modalidad, $numeroOrdenado, $users_id, $bancas_id, $comision, $request){


        $montoGlobal = self::MontoGlobal($parametrosBanca->montos_globales_id, $modalidad);

        if ($montoGlobal == 0) {

            return  response()->json(
                array(
                    'mensaje' => 'No tiene un Monto Global de apuesta asignada para esta modalidad',
                    'status' => 'MontoIndividual',
                )
            );

        }

        $montoIndividual = self::MontoIndividual($parametrosBanca->montos_individuales_id, $modalidad);

        if ($montoIndividual == 0) {
            return  response()->json(
                array(
                    'mensaje' => 'No tiene un Monto de apuesta minimo asignada para esta modalidad',
                    'status' => 'MontoIndividual',
                )
            );

        }

        /**
         * CONSULTA EL TOTAL DEL NUMERO JUGADO EN CONTROL DE NUMEROS POR TODAS LAS BANCAS
         */
        $totalGlobal = self::ControlNumeroGLobal($numeroOrdenado);

         /**
         * CONSULTA EL NUMERO JUGADO EN APUESTA TEMPORAL ACTUAL POR BANCA Y USUARIO
         */
        $apuestaTemporal = Util::numeroJugado($bancas_id, $users_id, $numeroOrdenado);
        if (empty($apuestaTemporal)) {
            $apt_valor = 0;
        } else {
            $apt_valor =  $apuestaTemporal->apt_valor;
        }


        /**
         * CONSULTA EL NUMERO JUGADO EN CONTROL DE NUMEROS POR LA BANCA
         */
        $totalndividual = Util::ControlNumeroJugado($loterias_id = null, $bancas_id, $users_id, $numeroOrdenado);



        /**
         * COMPARA EL MONTO INDIVIDUAL CON LO YA APOSTADO DEL NUMERO
         */

            $totalApuestaTemporal = $apt_valor + $request->tid_valor;
            $comparaciondividual = Util::compararValores($montoIndividual, $totalApuestaTemporal);

            if ($comparaciondividual == 1) {
                return response()->json(
                    array(
                        'mensaje' => 'La Apuesta Supera el Tope de Venta',
                        'status' => 'LimiteSuperado',
                    )
                );
            }

             if (empty($apuestaTemporal)) {
            TicketDetalle::GenerarApuesta($request, $numeroOrdenado, $modalidad, $comision);
        } else {
            TicketDetalle::ModificarApuesta($apuestaTemporal->id, $request->tid_valor, $apuestaTemporal->apt_valor,  $comision);
        }


    }



    public static function Comision($comision, $modalida)
    {
        $marketService = resolve(MarketService::class);

        $comision = $marketService->getComisionDetalle($comision);
        $output = '';
        if ($modalida == 1) {
            $output = $comision->com_quiniela;
        } elseif ($modalida == 2) {
            $output = $comision->com_pale;
        } elseif ($modalida == 3) {
            $output = $comision->com_tripleta;
        }
        if ($modalida == 4) {
            $output = $comision->com_superpale;
        }
        return $output;
    }

    public static function MontoGlobal($montoGlobal, $modalida)
    {

        $marketService = resolve(MarketService::class);

        $montoGlobal = $marketService->getMontoGlobalDetalle($montoGlobal);

        $output = '';
        if ($modalida == 1) {
            $output = $montoGlobal->mtg_quiniela;
        } elseif ($modalida == 2) {
            $output = $montoGlobal->mtg_pale;
        } elseif ($modalida == 3) {
            $output = $montoGlobal->mtg_tripleta;
        }
        if ($modalida == 4) {
            $output = $montoGlobal->mtg_superpale;
        }
        return $output;
    }

    public static function MontoIndividual($montoIndividual, $modalida)
    {
        $marketService = resolve(MarketService::class);

        $montoIndividual = $marketService->getMontoIndividualDetalle($montoIndividual);

        $output = '';
        if ($modalida == 1) {
            $output = $montoIndividual->mti_quiniela;
        } elseif ($modalida == 2) {
            $output = $montoIndividual->mti_pale;
        } elseif ($modalida == 3) {
            $output = $montoIndividual->mti_tripleta;
        }
        if ($modalida == 4) {
            $output = $montoIndividual->mti_superpale;
        }
        return $output;
    }

    public static function ControlNumeroGLobal($cnj_numero)
    {
        $marketService = resolve(MarketService::class);

        $data['cnj_fecha'] = date('Y-m-d');
        $data['cnj_numero'] = $cnj_numero;
        $data['empresas_id'] = session()->get('user.emp_id');

        $control = $marketService->getControlJugadaGlobal($data);

        return  !empty($control->cnj_contador) ? $control->cnj_contador : 0;

    }


}
