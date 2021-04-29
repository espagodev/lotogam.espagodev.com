<?php

namespace App\Utils;

use App\Services\MarketService;
use Carbon\Carbon;

class HorarioLoterias
{
    public static function horaRD()
    {
        return with(new Carbon(date('H:i:s')))->tz('America/Santo_Domingo')->format('H:i:s');
    }

    //DIA ACTUAL
    public static function fechaActual()
    {
        return date(session()->get('business.date_format'));
    }

    //DIA DE DE LA FECHA SELECCIONADA
    public static function dia($fecha)
    {
        return date('N', strtotime($fecha));
    }

    //FORMATO DE FECHA
    public static function formatoFecha($fecha)
    {
        return Carbon::createFromFormat('d/m/Y', $fecha)->format('Y-m-d');
    }

    static function compararFechas($fechaVigencia)
    {

        $fecha_actual = date('Y-m-d');

        // $fecha_actual = Carbon::parse($hoy);
        // $fechaVigencia =  Carbon::createFromFormat('d/m/Y', $fechaInicial)->format('d-m-Y');
        // $fechaVigencia =  Carbon::createFromFormat('d/m/Y', $fechaInicial)->format('d-m-Y');

        // dd(($fecha_actual==$fechaVigencia), $fecha_actual, $fechaVigencia);
        if (($fecha_actual == $fechaVigencia) == 'true') {
            return 1;
        } if(($fecha_actual > $fechaVigencia) == 'true'){
            return 0;
        }

    }

    static function compararHoras($horaLoteria, $horaRd)
    {
        if (($horaRd >= $horaLoteria) == 'true') {
            return 1;
         } else {
            return 0;
        }
    }


    public static function horario($banca = null, $empresas_id, $loterias_id)
    {
        $marketService = resolve(MarketService::class);

        if (is_null($banca)) {
            $horarios = $marketService->getloteriaHorario($empresas_id, $loterias_id);
        } else {
            // $horarios = HorarioUsuario::loteriaHorarioUsuario($banca, $empresa, $loteria);
        }

        if (count($horarios) > 0) {
            $collection = collect($horarios);
            $collection->map(function ($horario) {
                $horario->hlo_hora_inicio = $horario->hlo_hora_inicio;
                $horario->hlo_hora_fin = $horario->hlo_hora_fin;

                return $horario;
            });
        } else {
            // $horarios = collect();
            // for ($i = 1; $i <= 7; $i++)
            //     if (is_null($banca)) {

            //         $data = ["_method" => "PUT", 'hlo_activo' => [$i], 'hlo_hora_inicio' => ['00:00'], 'hlo_hora_fin' => ['00:00'], 'hlo_minutos' => ['0'], 'empresas_id' => $empresas_id, 'loterias_id' => $loterias_id];
            //         $horarios->push($marketService->ModificarHorarioLoteria($loterias_id, $data));
            //     } else {
            //         // $horarios->push(new HorarioUsuario());
            //     }
            $horarios =  self::horarioDias($empresas_id, $loterias_id);

        }

        return $horarios;
    }



    public static function horarioDias($empresas_id, $loterias_id, $banca = null)
    {
        $data = [];
         for ($i = 1; $i < 8; $i++){
            $data = ["_method" => "PUT", 'hlo_activo' => [$i], 'hlo_hora_inicio' => ['00:00'], 'hlo_hora_fin' => ['00:00'], 'hlo_minutos' => ['0'], 'empresas_id' => $empresas_id, 'loterias_id' => $loterias_id];
            $data = self::getActualizarHorarioLoteria($loterias_id, $data);
        }
        return $data;
    }

    public static function getActualizarHorarioLoteria($loterias_id, $data)
    {
        // dd($loterias_id, $data);
        $marketService = resolve(MarketService::class);
        $data =  $marketService->ModificarHorarioLoteria($loterias_id, $data);

        return $data;
    }


    public static function getHorarioLoteriasDia($empresas_id, $dia)
    {
        // dd($empresas_id, $dia);
        $marketService = resolve(MarketService::class);
        $data =  $marketService->getHorarioLoteriasDia($empresas_id, $dia);

        return $data;
    }

}
