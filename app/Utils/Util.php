<?php

namespace App\Utils;

use App\Services\MarketService;
use Carbon\Carbon;

class Util
{
    public static function modalidad($numero)
    {
        $modalida = strlen($numero);
        if ($modalida == '2') {
            $mod = '1';
        } elseif ($modalida == '4') {
            $mod = '2';
        } else {
            $mod = '3';
        }

        return $mod;
    }

    public static function ordenarNumeros($numero, $modalida)
    {

        if ($modalida == 2) {
            $numero1 = substr($numero, 0, 2);
            $numero2 = substr($numero, 2, 2);
            $arrayM2 = [$numero1, $numero2];
            sort($arrayM2, SORT_NUMERIC);
            $numero = trim(implode("", $arrayM2));
        } elseif ($modalida == 3) {
            $numero1 = substr($numero, 0, 2);
            $numero2 = substr($numero, 2, 2);
            $numero3 = substr($numero, 4, 2);
            $arrayM3 = [$numero1, $numero2, $numero3];

            sort($arrayM3, SORT_NUMERIC);
            $numero = trim(implode("", $arrayM3));
        }
        return $numero;
    }

    public static function numeroValido($numero)
    {

        $totalDigitos = strlen($numero);

        if ($totalDigitos == '1') {
            $NumeroValidado =  sprintf("%02d", $numero);
        } else {
            $NumeroValidado = $numero;
        }

        return $NumeroValidado;
    }

    public static function numeroJugado($bancas_id, $users_id, $numero)
    {
        $marketService = resolve(MarketService::class);

        $data = $marketService->getApuestaDetalleTempJugada($bancas_id, $users_id, $numero);

        if (is_null($data)) {
            return 0;
        } else {
            return $data;
        }
    }

    public static function ControlNumeroJugado($loterias_id, $bancas_id = null, $users_id = null, $cnj_numero)
    {
        $marketService = resolve(MarketService::class);

        $data['cnj_fecha'] = date('Y-m-d');
        $data['bancas_id'] = $bancas_id;
        $data['cnj_numero'] = $cnj_numero;
        $data['empresas_id'] = session()->get('user.emp_id');
        $data['users_id'] =  $users_id;
        $data['loterias_id'] =  $loterias_id;

        $control = $marketService->getConsultaControlJugada($data);

        if (empty($control)) {
            return  0;
        } else {
            return $control->cnj_contador;
        }
    }



    public static function compararValores($monto, $apuesta)
    {

        if ($apuesta > $monto) {
            $resultado = 1;
        } else {
             $resultado = 0;
        }

        return $resultado;
    }

    public static function totalApuesta($apuesta, $vendido)
    {

        if ($vendido != 0) {
            return ($apuesta + $vendido);
        } else {

            return  $apuesta;
        }
    }

    public static function comparaValorExistente($montoExistente, $apuesta, $montoPermitido)
    {
        //dd($montoExistente, $apuesta, $montoPermitido);

        if ($montoExistente == 0) {
            $Monto = 0;
        } else {
            $Monto = $montoExistente->apd_valor;
        }

        $nuevoMonto = $Monto + $apuesta;


        if ($nuevoMonto > $montoPermitido) {
            return $resultado = 1;
        } else {
            return $resultado = 0;
        }
    }

    /**
     * Calculates percentage
     *
     * @param int $base //valor
     * @param int $number //comision
     *
     * @return float
     */
    public static function get_percent($valor, $comision)
    {

        $porcentaje = ((float)$valor * $comision) / 100; // Regla de tres
        // $porcentaje = round($porcentaje, 0);  // Quitar los decimales
        return $porcentaje;
    }

    public static function get_progress($valor, $comision)
    {

        $porcentaje = ((float)$valor * 100) / $comision; // Regla de tres
        $porcentaje = round($porcentaje, 0);  // Quitar los decimales
        return $porcentaje;
    }

    public static function totalloterias($loterias)
    {

        return $Contloteria = count($loterias);
    }


    /**
     * Impresion Automatica
     */
    public static function totalDigitos()
    {
        return [
            '4' => '4',
            '5' => '5',
            '6' => '6',
            '7' => '7',
            '8' => '8',
            '9' => '9',
            '10' => '10',
        ];
    }

    /**
     * This function formats a number and returns them in specified format
     *
     * @param int $input_number
     * @param boolean $add_symbol = false
     * @param array $business_details = null
     * @param boolean $is_quantity = false; If number represents quantity
     *
     * @return string
     */
    public static function num_f($input_number, $add_symbol = false, $business_details = null, $is_quantity = false)
    {

        $thousand_separator = !empty($business_details) ? $business_details->separador_miles : session('currency')['thousand_separator'];
        $decimal_separator = !empty($business_details) ? $business_details->separador_decimal : session('currency')['decimal_separator'];

        $currency_precision = config('constants.currency_precision', 2);

        if ($is_quantity) {
            $currency_precision = config('constants.quantity_precision', 2);
        }

        $formatted = number_format($input_number, $currency_precision, $decimal_separator, $thousand_separator);

        if ($add_symbol) {
            $currency_symbol_placement = !empty($business_details) ? $business_details->simbolo : session('business.currency_symbol_placement');
            $symbol = !empty($business_details) ? $business_details->simbolo : session('currency')['symbol'];

            if ($currency_symbol_placement == 'after') {
                $formatted = $formatted . ' ' . $symbol;
            } else {
                $formatted = $symbol . ' ' . $formatted;
            }
        }

        return $formatted;
    }

    /**
     * Devuelve la configuración predeterminada para el ticket.
     *
     * @return array
     */
    public function ticketConfigShow()
    {
        return ['tcon_show_time' => 0,
                'tcon_show_logo' => 0,
                'tcon_show_business_name' => 0,
                'tcon_show_location_name' => 0,
                'tcon_show_sorteo' => 0,
                'tcon_show_eslogan' => 0,
                'tcon_show_city' => 0,
                'tcon_show_state' => 0,
                'tcon_show_zip_code' => 0,
                'tcon_show_country' => 0,
                'tcon_show_mobile_number' => 0,
                'tcon_show_alternate_number' => 0,
                'tcon_show_email' => 0,
                'tcon_show_barcode' => 0,
                'tcon_show_barcode_qr' => 0,
                'tcon_show_nota' => 0,
                'tcon_is_default' => 0,
                'tcon_show_sorteo' => 0
               ];
    }

    /**
     * Devuelve la configuración predeterminada para el ticket.
     *
     * @return array
     */
    public function bancaConfigShow()
    {
        return [
            'ban_venta_futuro' => 0,
            'ban_promocion' => 0,
        ];
    }

    /**
     * Devuelve la configuración predeterminada para el ticket.
     *
     * @return array
     */
    public function ticketPromocionShow()
    {
        return [
            'tic_promocion' => 0,
        ];
    }

    public static function dias()
    {
        return [
                1 => 'Lunes',
                2 => 'Martes',
                3 => 'Miercoles',
                4 => 'Jueves',
                5 => 'Viernes',
                6 => 'Sabado',
                7 => 'Domingo'
        ];
    }


    public static function tipoConexion()
    {
        return [
            'network' => 'Network',
            'windows' => 'Windows',
            'linux' => 'Linux'
        ];
    }

    public static function perfilCapacidad()
    {
        return [
            'default' => 'Default',
            'simple' => 'Simple',
            'SP2000' => 'Star Branded',
            'TEP-200M' => 'Espon Tep',
            'P822D' => 'P822D'
        ];
    }

    /**
     * Da el año financiero actual
     *
     * @return array
     */
    public function getCurrentFinancialYear($empresas_id = null)
    {
        // $business = Business::where('id', $empresas_id)->first();
        // $start_month = $business->fy_start_month;
        $start_month = 1;
        $end_month = $start_month - 1;
        if ($start_month == 1) {
            $end_month = 12;
        }

        $start_year = date('Y');
        //si el mes actual es menor que el mes de inicio, cambie el año de inicio al año pasado
        if (date('n') < $start_month) {
            $start_year = $start_year - 1;
        }

        $end_year = date('Y');
        //si el mes actual es mayor que el mes final, cambie el año final al año siguiente
        if (date('n') > $end_month) {
            $end_year = $start_year + 1;
        }
        $start_date = $start_year . '-' . str_pad($start_month, 2, 0, STR_PAD_LEFT) . '-01';
        $end_date = $end_year . '-' . str_pad($end_month, 2, 0, STR_PAD_LEFT) . '-01';
        $end_date = date('Y-m-t', strtotime($end_date));

        $output = [
            'start' => $start_date,
            'end' =>  $end_date
        ];
        return $output;
    }

    /**
     * Devuelve la configuración activa del horario.
     *
     * @return array
     */
    public function horarioConfigShow()
    {
        return [
            'hlo_activo' => 0,
        ];
    }


    /**
     * estados ticket
     */
    public static function estadosTicket()
    {
        return [
            '1' => 'Normal',
            '2' => 'Premiado',
            '3' => 'Pagado',

        ];
    }

    /**
     * estados ticket
     */
    public static function estadosPromocionTicket()
    {
        return [
            '1' => 'Promocion',
        ];
    }

    public static function registrosPorPagina()
    {
        return [
            '25' => '25',
            '50' => '50',
            '100' => '100',
            '200' => '200',
            '500' => '500',
            '1000' => '1000',
            '-1' => 'Todos'
        ];
    }

    public static function themeColors()
    {
            return[
            'blue' => 'Blue',
            'black' => 'Black',
            'purple' => 'Purple',
            'green' => 'Green',
            'red' => 'Red',
            'yellow' => 'Yellow',
            'blue-light' => 'Blue Light',
            'black-light' => 'Black Light',
            'purple-light' => 'Purple Light',
            'green-light' => 'Green Light',
            'red-light' => 'Red Light'
        ];
    }


    /**
     * Formato impresion por navegador
     */
    public static function formatoBrowser()
    {
        return [
            'formato80' => 'Pos 80 (Recomendado para impresora de recibos de linea térmica, tamaño de papel de 80 mm)',
            'formato58' => 'Pos 58-80 (Recomendado para impresora de recibos de linea térmica, tamaño de papel de 80 mm y 58 mm)',
        ];
    }

    /**
     * @param string $fecha_creacion
     */
    static function calcularMinutos($fecha_creacion, $tiempo_anular)
    {
        $created = new Carbon($fecha_creacion);
        $now =  Carbon::now()->toDateTimeString();

        if ($created->diffInMinutes($now) > $tiempo_anular) {
            return 1;
        } else {
            return 0;
        }
    }

    /**
     * Devuelve la configuración de usuarios para ingresar resultados
     *
     * @return array
     */
    public function userConfigShow()
    {
        return [
            'use_resultados' => 0,
            'use_bloquea_banca' => 0
        ];
    }

    public static function registroInformes()
    {
        return [
            'Abierto' => 'Abierto',
            'Cerrado' => 'Cerrado'
        ];
    }

    /**
     * Convierte la fecha en formato mysql a formato comercial
     *
     * @param string $date
     * @param bool $time (default = false)
     * @return strin
     */
    public function format_date($date, $show_time = false, $business_details = null)
    {
        $format = !empty($business_details) ? $business_details->date_format : session('business.date_format');
        if (!empty($show_time)) {
            $time_format = !empty($business_details) ? $business_details->time_format : session('business.time_format');
            if ($time_format == 12) {
                $format .= ' h:i A';
            } else {
                $format .= ' H:i';
            }
        }

        return !empty($date) ? Carbon::createFromTimestamp(strtotime($date))->format($format) : null;
    }

    public static function movimientosCaja()
    {
        return [
            'entrada' => 'Entrada',
            'salida' => 'Salida',
            'traslado' => 'Traslado',
            'cupo' => 'Apertura de Cupo'
        ];
    }

}
