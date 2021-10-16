<?php

namespace App\Utils;

use App\Services\MarketService;
use Carbon\Carbon;

class HorarioLoterias
{
    public static function horaRD()
    {
        return with(new Carbon(date('H:i')))->tz('America/Santo_Domingo')->format('H:i');
    }

    //DIA ACTUAL
    public static function fechaActual()
    {
        return date(session()->get('business.date_format'));
    }

    //DIA DE DE LA FECHA SELECCIONADA
    public static function dia()
    {
        // return date('N', strtotime($fecha));
        return  with(new Carbon(strtotime('N')))->tz('America/Santo_Domingo')->format('N');
    }

    //FORMATO DE FECHA
    public static function formatoFecha($fecha)
    {
        return Carbon::createFromFormat('d/m/Y', $fecha)->format('Y-m-d');
    }

    static function compararFechas($fechaSeleccionada, $fecha_actual)
    {

        if (($fecha_actual == $fechaSeleccionada) == 'true') {
            return 1;
        } if(($fecha_actual > $fechaSeleccionada) == 'true'){
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

    public static function horario($empresas_id, $loterias_id)
    {
        $marketService = resolve(MarketService::class);

        $horarios = $marketService->getloteriaHorario($empresas_id, $loterias_id);
        

        // if (count($horarios) > 0) {
        //     $collection = collect($horarios);
        //     $collection->map(function ($horario) {
        //         $horario->hlo_hora_inicio = $horario->hlo_hora_inicio;
        //         $horario->hlo_hora_fin = $horario->hlo_hora_fin;

        //         return $horario;
        //     });
        // } else {
        //     // $horarios = collect();
        //     // for ($i = 1; $i <= 7; $i++)
        //     //     if (is_null($banca)) {

        //     //         $data = ["_method" => "PUT", 'hlo_activo' => [$i], 'hlo_hora_inicio' => ['00:00'], 'hlo_hora_fin' => ['00:00'], 'hlo_minutos' => ['0'], 'empresas_id' => $empresas_id, 'loterias_id' => $loterias_id];
        //     //         $horarios->push($marketService->ModificarHorarioLoteria($loterias_id, $data));
        //     //     } else {
        //     //         // $horarios->push(new HorarioUsuario());
        //     //     }
        //     $horarios =  self::horarioDias($empresas_id, $loterias_id);

        // }

        return $horarios;
    }

    public static function horarioDias($empresas_id, $loterias_id)
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
        $marketService = resolve(MarketService::class);
        
        $data =  $marketService->ModificarHorarioLoteria($loterias_id, $data);

        return $data;
    }

    // public static function getHorarioLoteriasDia($empresas_id, $dia)
    // {
    //     $marketService = resolve(MarketService::class);
    //     $data =  $marketService->getHorarioLoteriasDia($empresas_id, $dia);

    //     return $data;
    // }

    public static function getHorarioLoteriasDia($data)
    {
        $marketService = resolve(MarketService::class);
       
        $data =  $marketService->getHorarioLoteriasDia($data);

        return $data;
    }

    public static function getHorarioCierre($data)
    {
        $marketService = resolve(MarketService::class);
       
        $data =  $marketService->getHorarioCierre($data);

        return $data;
    }

    public static function getLoteriasSuperPaleDia($data)
    {
        $marketService = resolve(MarketService::class);
       
        $data =  $marketService->getLoteriasSuperPaleDia($data);

        return $data;
    }

    /**
     * HORARIO PARA BANCAS
     */
    public static function horarioBancaDias($empresas_id, $bancas_id, $loterias_id)
    {
        $data = [];
         for ($i = 1; $i < 8; $i++){
            $data = ["_method" => "PUT", 'hlo_activo' => [$i], 'hlo_hora_inicio' => ['00:00'], 'hlo_hora_fin' => ['00:00'], 'hlo_minutos' => ['0'], 'empresas_id' => $empresas_id, 'bancas_id' => $bancas_id, 'loterias_id' => $loterias_id];
        }

        
        $data = self::getActualizarHorarioBancaLoteria($loterias_id, $data);
        return $data;
    }

    public static function BancaHorario($empresas_id, $bancas_id, $loterias_id)
    {
        $marketService = resolve(MarketService::class);      
        $horario = $marketService->getloteriaBancaHorario($empresas_id,$bancas_id, $loterias_id);        
            
        return $horario;
    }

    public static function getActualizarHorarioBancaLoteria($loterias_id, $data)
    {
        $marketService = resolve(MarketService::class);
        $data =  $marketService->ModificarHorarioBancaLoteria($loterias_id, $data);

        return $data;
    }

    /**
     * HORARIO PARA usuarios
     */
    public static function horarioUsuarioDias($users_id, $loterias_id)
    {
        $data = [];
         for ($i = 1; $i < 8; $i++){
            $data = ["_method" => "PUT", 'hlo_activo' => [$i], 'hlo_hora_inicio' => ['00:00'], 'hlo_hora_fin' => ['00:00'], 'hlo_minutos' => ['0'], 'user_id' => $users_id, 'loterias_id' => $loterias_id];
            $data = self::getActualizarHorarioUsuarioLoteria($loterias_id, $data);
        }
        return $data;
    }

    public static function UsuarioHorario($empresas_id, $users_id, $loterias_id)
    {
        $marketService = resolve(MarketService::class);


        $horarios = $marketService->getloteriaUsuarioHorario($empresas_id, $users_id, $loterias_id);

        // if (count($horarios) > 0) {
        //     $collection = collect($horarios);
        //     $collection->map(function ($horario) {
        //         $horario->hlo_hora_inicio = $horario->hlo_hora_inicio;
        //         $horario->hlo_hora_fin = $horario->hlo_hora_fin;

        //         return $horario;
        //     });
        // } else {
        //     $horarios =  self::horarioUsuarioDias($users_id, $loterias_id);
        // }

        return $horarios;
    }

    public static function getActualizarHorarioUsuarioLoteria($loterias_id, $data)
    {
        $marketService = resolve(MarketService::class);
        $data =  $marketService->ModificarHorarioUsuarioLoteria($loterias_id, $data);

        return $data;
    }
}
