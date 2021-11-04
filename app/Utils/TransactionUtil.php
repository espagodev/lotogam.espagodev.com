<?php

namespace App\Utils;

use App\Services\MarketService;
use Carbon\Carbon;

class TransactionUtil extends Util
{



    /**
     * Gives the receipt details in proper format.
     *
     * @param int $location_id
     * @param object $invoice_layout
     * @param array $empresas_detalle
     * @param array $receipt_details
     * @param string $receipt_printer_type
     *
     * @return array
     */
    public function getReceiptDetails($tickets, $invoice_layout, $empresas_detalle, $moneda, $banca, $receipt_printer_type, $ticketDetalle, $isAnular , $ticket_copia)
    {

        $il = $invoice_layout;

        $output = [
            'slogan' => isset($il->tcon_slogan) ? $il->tcon_slogan : '',
            'business_name' => ($il->tcon_show_business_name == 1) ? $empresas_detalle->emp_nombre : '',
            'location_name' => ($il->tcon_show_location_name == 1) ? $banca->ban_nombre : '',
            'loteria' => $tickets[0]->lot_nombre,
        ];

        //Nombre para mostrar
        $output['display_name'] = $output['business_name'];
        if (!empty($output['location_name'])) {
            if (!empty($output['display_name'])) {
                $output['display_name'] .= ', ';
            }
            $output['display_name'] .= $output['location_name'];
        }

        //Logo
        // $output['logo'] = $il->tcon_show_logo != 0 && !empty($il->logo) && file_exists(public_path('uploads/invoice_logos/' . $il->logo)) ? asset('uploads/invoice_logos/' . $il->logo) : false;
        if ($il->tcon_show_logo == 1) {
            $output['logo']  = $il->tcon_logo;
            $output['logo_base']  = $il->tcon_logo_base;
        }
        //$output['logo'] = $il->logo == 1 && !empty($il->logo) && file_exists(public_path('uploads/invoice_logos/' . $il->logo)) ? asset('uploads/invoice_logos/' . $il->logo) : false;

        //Address
        $output['address'] = '';
        $temp = [];
        if ($il->tcon_show_city == 1 &&  !empty($banca->city)) {
            $temp[] = $banca->city;
        }
        if ($il->tcon_show_state == 1 &&  !empty($banca->state)) {
            $temp[] = $banca->state;
        }
        if ($il->tcon_show_zip_code == 1 &&  !empty($banca->zip_code)) {
            $temp[] = $banca->zip_code;
        }
        if ($il->tcon_show_country == 1 &&  !empty($banca->country)) {
            $temp[] = $banca->country;
        }
        if (!empty($temp)) {
            $output['address'] .= implode(',', $temp);
        }

        $output['website'] = $banca->ban_website;


        //Información de contacto de la tienda
        $output['contact'] = '';
        if ($il->tcon_show_mobile_number == 1 && !empty($banca->mobile)) {
            $output['contact'] .= 'Mobil: ' . $banca->mobile;
        }
        if ($il->tcon_show_alternate_number == 1 && !empty($banca->alternate_number)) {
            if (empty($output['contact'])) {
                $output['contact'] .= 'Mobil: ' . $banca->alternate_number;
            } else {
                $output['contact'] .= ', ' . $banca->alternate_number;
            }
        }
        if ($il->tcon_show_email == 1 && !empty($banca->email)) {
            if (!empty($output['contact'])) {
                $output['contact'] .= "\n";
            }
            $output['contact'] .= 'Email: ' . $banca->email;
        }

        //Información del ticket
        $output['invoice_no'] = $tickets[0]->tic_ticket;

        if ($isAnular == '0') {
            $output['pin_no'] = $tickets[0]->tic_pin;
            $output['pin_no_prefix'] = $il->tcon_etiqueta_pin;
        }

        $output['invoice_no_prefix'] = $il->tcon_etiqueta_ticket;

        if ($il->tcon_show_eslogan == 1 ){
            $output['invoice_eslogan'] = $il->tcon_slogan;
        }

        $output['date_label'] = $il->tcon_date_label;
        $output['invoice_date'] = Carbon::createFromFormat('Y-m-d H:i:s', $tickets[0]->tic_fecha_sorteo)->format($il->tcon_date_time_format);

        $output['time_label'] = 'Hora:';
        $output['time_date'] = Carbon::createFromFormat('Y-m-d H:i:s', $tickets[0]->tic_fecha_sorteo)->format('H:i');


        if ($il->tcon_show_sorteo == 1 &&  !empty($il->tcon_sorteo_label)) {
            $output['sorteo_label'] = $il->tcon_sorteo_label;
            $output['sorteo_date'] = Carbon::createFromFormat('Y-m-d H:i:s', $tickets[0]->tic_fecha_sorteo)->format($il->tcon_date_time_format);
        }

        $tcon_show_currency = true;
        if ($receipt_printer_type == 'printer' && trim($moneda->simbolo) != '$') {
            $tcon_show_currency = false;
        }

        $output['lines'] = [];

        $details = self::_receiptDetailsSellLines($ticketDetalle, $tcon_show_currency, $moneda);
        $output['lines'] = $details;


        $output['total_label'] =  'Total:';
        $total = Util::num_f($tickets[0]->tic_apostado, $tcon_show_currency, $moneda, false);
        $output['total'] = $total;

        $output['promocion_label'] = '';
        if ($tickets[0]->tic_promocion == '1') {
            $promocion = self::promocionTicket($tickets[0]->tic_promocion);
            $output['promocion_label'] = $promocion;
        }

        $output['copia_label'] = '';
        if ($ticket_copia == true) {
            $copia = self::ticketCopia($ticket_copia);
            $output['copia_label'] = $copia;
            $output['copia_date'] = date("d/m/Y H:i");
        }

        $output['estado_label'] = '';
        $estado = self::estadoTicket($tickets[0]->tic_estado);
        $output['estado_label'] = $estado;

        //Check for barcode
        $output['barcode'] = ($il->tcon_show_barcode == 1) ? $tickets[0]->tic_ticket : false;

        //Additional notes
        $output['footer_text'] = $il->tcon_ticket_mensaje;

        //Barcode related information.
        $output['tcon_show_barcode'] = !empty($il->tcon_show_barcode) ? true : false;

        if ($il->tcon_show_nota == 1) {
            $output['tcon_nota_informativa'] = $il->tcon_nota_informativa;
        }
        return (object) $output;
    }

    /**
     * Gives the receipt details in proper format.
     *
     * @param int $location_id
     * @param object $invoice_layout
     * @param array $empresas_detalle
     * @param array $receipt_details
     * @param string $receipt_printer_type
     *
     * @return array
     */
    public function getReceiptDetailsAgrupado($tickets, $invoice_layout, $empresas_detalle, $moneda, $banca, $receipt_printer_type, $ticketDetalle, $agrupado, $total, $isAnular)
    {

        $il = $invoice_layout;

        $output = [
            'slogan' => isset($il->tcon_slogan) ? $il->tcon_slogan : '',
            'business_name' => ($il->tcon_show_business_name == 1) ? $empresas_detalle->emp_nombre : '',
            'location_name' => ($il->tcon_show_location_name == 1) ? $banca->ban_nombre : '',

        ];

        //Nombre para mostrar
        $output['display_name'] = $output['business_name'];
        if (!empty($output['location_name'])) {
            if (!empty($output['display_name'])) {
                $output['display_name'] .= ', ';
            }
            $output['display_name'] .= $output['location_name'];
        }

        //Logo
        // $output['logo'] = $il->tcon_show_logo != 0 && !empty($il->logo) && file_exists(public_path('uploads/invoice_logos/' . $il->logo)) ? asset('uploads/invoice_logos/' . $il->logo) : false;
        if ($il->tcon_show_logo == 1) {
            $output['logo']  = $il->tcon_logo;
        }
        //$output['logo'] = $il->logo == 1 && !empty($il->logo) && file_exists(public_path('uploads/invoice_logos/' . $il->logo)) ? asset('uploads/invoice_logos/' . $il->logo) : false;

        //Address
        $output['address'] = '';
        $temp = [];
        if ($il->tcon_show_city == 1 &&  !empty($banca->city)) {
            $temp[] = $banca->city;
        }
        if ($il->tcon_show_state == 1 &&  !empty($banca->state)) {
            $temp[] = $banca->state;
        }
        if ($il->tcon_show_zip_code == 1 &&  !empty($banca->zip_code)) {
            $temp[] = $banca->zip_code;
        }
        if ($il->tcon_show_country == 1 &&  !empty($banca->country)) {
            $temp[] = $banca->country;
        }
        if (!empty($temp)) {
            $output['address'] .= implode(',', $temp);
        }

        $output['website'] = $banca->ban_website;


        //Información de contacto de la tienda
        $output['contact'] = '';
        if ($il->tcon_show_mobile_number == 1 && !empty($banca->mobile)) {
            $output['contact'] .= 'Mobil: ' . $banca->mobile;
        }
        if ($il->tcon_show_alternate_number == 1 && !empty($banca->alternate_number)) {
            if (empty($output['contact'])) {
                $output['contact'] .= 'Mobil: ' . $banca->alternate_number;
            } else {
                $output['contact'] .= ', ' . $banca->alternate_number;
            }
        }
        if ($il->tcon_show_email == 1 && !empty($banca->email)) {
            if (!empty($output['contact'])) {
                $output['contact'] .= "\n";
            }
            $output['contact'] .= 'Email: ' . $banca->email;
        }

        $output['tickets'] = [];

        $ticket = self::_receiptDetailsSellTckets($tickets);
        $output['tickets'] = $ticket;

        if ($il->tcon_show_eslogan == 1) {
            $output['invoice_eslogan'] = $il->tcon_slogan;
        }

        $output['date_label'] = $il->tcon_date_label;
        $output['invoice_date'] = Carbon::createFromFormat('Y-m-d H:i:s', $agrupado['created_at'])->format($il->tcon_date_time_format);

        $output['time_label'] = 'Hora:';
        $output['time_date'] = Carbon::createFromFormat('Y-m-d H:i:s', $agrupado['created_at'])->format('H:i');


        if ($il->tcon_show_sorteo == 1 &&  !empty($il->tcon_sorteo_label)) {
            $output['sorteo_label'] = $il->tcon_sorteo_label;
            $output['sorteo_date'] = Carbon::createFromFormat('Y-m-d H:i:s', $agrupado['tic_fecha_sorteo'])->format($il->tcon_date_time_format);

        }

        $tcon_show_currency = true;
        if ($receipt_printer_type == 'printer' && trim($moneda->simbolo) != '$') {
            $tcon_show_currency = false;
        }


        $output['lines'] = [];

        $details = self::_receiptDetailsSellLines($ticketDetalle, $tcon_show_currency, $moneda);
        $output['lines'] = $details;


        $output['total_label'] =  'Total:';
        $total = Util::num_f($total['tic_apostado'], $tcon_show_currency, $moneda, false);
        $output['total'] = $total;

        $output['promocion_label'] = '';
        if ($agrupado['tic_promocion'] == '1') {
            $promocion = self::promocionTicket($agrupado['tic_promocion']);
            $output['promocion_label'] = $promocion;
        }

        // $output['estado_label'] = '';
        // $estado = self::estadoTicket($tickets[0]->tic_estado);
        // $output['estado_label'] = $estado;

        // //Check for barcode
        $output['barcode'] = ($il->tcon_show_barcode == 1) ? $tickets[0]['tic_ticket'] : false;

        //Additional notes
        $output['footer_text'] = $il->tcon_ticket_mensaje;

        //Barcode related information.
        $output['tcon_show_barcode'] = !empty($il->tcon_show_barcode) ? true : false;

        if ($il->tcon_show_nota == 1) {
            $output['tcon_nota_informativa'] = $il->tcon_nota_informativa;
        }
        return (object) $output;
    }

    /**
     * Returns each line details for sell invoice display
     *
     * @return array
     */
    protected static function _receiptDetailsSellLines($lines, $tcon_show_currency, $moneda) 
    {
        // dd($lines, $tcon_show_currency, $moneda);
        foreach ($lines as $line) {

            $apuesta = $line->tid_apuesta;
            $valor = $line->tid_valor;
            $modalidad = $line->mod_codigo;

            $line_array = [

                'modalidad' => $modalidad,
                'apuesta' => $apuesta,
                'valor' => Util::num_f($valor, $tcon_show_currency, $moneda, false),

            ];

            //If modifier is set set modifiers line to parent sell line

            $output_lines[] = $line_array;
        }

        return  $output_lines;
    }

    /**
     * Returns each line details for sell invoice display
     *
     * @return array
     */
    protected static function _receiptDetailsSellTckets($ticket)
    {

        foreach ($ticket as $line) {

            $ticket = $line['tic_ticket'];
            $pin = $line['tic_pin'];
            $loteria = $line['lot_nombre'];

            $line_array = [

                'ticket' => $ticket,
                'pin' => $pin,
                'loteria' => $loteria,

            ];

            //If modifier is set set modifiers line to parent sell line

            $output_lines[] = $line_array;
        }

        return  $output_lines;
    }

    public static function ticketCopia($ticket_copia)
    {
        $output = '';
        if ($ticket_copia == true) {
            $output .= " ******* COPIA ******* ";
        }
        return $output;
    }

    public static function promocionTicket($promocion)
    {
        $output = '';
        if ($promocion == 1) {
            $output .= " ******* PROMOCION ******* ";
        }
        return $output;
    }

    public static function estadoTicket($estado)
    {

        $output = '';
        if ($estado == 0) {
            $output .= " ******* ANULADO ******* ";
        } elseif ($estado == 2) {
            $output .= " ******* PREMIADO ******* ";
        } elseif ($estado == 3) {
            $output .= " ******* PAGADO ******* ";
        }


        return $output;
    }


}
