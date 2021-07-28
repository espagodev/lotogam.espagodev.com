<?php

namespace App\Utils;

use App\Services\MarketService;
use Carbon\Carbon;

class FormatoTickets
{


    public static function getReceiptDetails($transaction, $invoice_layout, $empresas_detalle, $moneda, $location_details, $receipt_printer_type, $detalle, $isAnular)
    {

        $transaction = $transaction[0];
        $il = $invoice_layout;

        $output = [
            'slogan' => isset($il->tcon_slogan) ? $il->tcon_slogan : '',
            'business_name' => ($il->tcon_show_business_name == 1) ? $empresas_detalle->emp_nombre : '',
            'location_name' => ($il->tcon_show_location_name == 1) ? $location_details->ban_nombre : '',
            'loteria' => $transaction->lot_nombre,
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
        if ($il->tcon_show_city == 1 &&  !empty($location_details->city)) {
            $temp[] = $location_details->city;
        }
        if ($il->tcon_show_state == 1 &&  !empty($location_details->state)) {
            $temp[] = $location_details->state;
        }
        if ($il->tcon_show_zip_code == 1 &&  !empty($location_details->zip_code)) {
            $temp[] = $location_details->zip_code;
        }
        if ($il->tcon_show_country == 1 &&  !empty($location_details->country)) {
            $temp[] = $location_details->country;
        }
        if (!empty($temp)) {
            $output['address'] .= implode(',', $temp);
        }

        $output['website'] = $location_details->ban_website;


        //Información de contacto de la tienda
        $output['contact'] = '';
        if ($il->tcon_show_mobile_number == 1 && !empty($location_details->mobile)) {
            $output['contact'] .= 'Mobile: ' . $location_details->mobile;
        }
        if ($il->tcon_show_alternate_number == 1 && !empty($location_details->alternate_number)) {
            if (empty($output['contact'])) {
                $output['contact'] .= 'Mobile: ' . $location_details->alternate_number;
            } else {
                $output['contact'] .= ', ' . $location_details->alternate_number;
            }
        }
        if ($il->tcon_show_email == 1 && !empty($location_details->email)) {
            if (!empty($output['contact'])) {
                $output['contact'] .= "\n";
            }
            $output['contact'] .= 'Email: ' . $location_details->email;
        }

        //Información del ticket
        $output['invoice_no'] = $transaction->tic_ticket;

        $output['pin_no_prefix'] = '';
        $output['pin_no'] = '';

         if($isAnular == 0){
            $output['pin_no_prefix'] = $il->tcon_etiqueta_pin;
            $output['pin_no'] = $transaction->tic_pin;
         }

        $output['invoice_no_prefix'] = $il->tcon_etiqueta_ticket;
        $output['invoice_eslogan'] = $il->tcon_slogan;



        $output['date_label'] = $il->tcon_date_label;
        $output['invoice_date'] = Carbon::createFromFormat('Y-m-d', $transaction->tic_fecha_sorteo)->format($il->tcon_date_time_format);
        $output['time_label'] = 'Hora:';
        $output['time_date'] = Carbon::createFromFormat('H:i:s', $transaction->tic_fecha_sorteo)->format('H:i');

        $output['sorteo_label'] = '';
        $output['sorteo_date'] = '';
        if ($il->tcon_show_sorteo == 1 &&  !empty($il->tcon_sorteo_label)) {
            $output['sorteo_label'] = $il->tcon_sorteo_label;
            $output['sorteo_date'] = Carbon::createFromFormat('Y-m-d', $transaction->tic_fecha_sorteo)->format($il->tcon_date_time_format);
        }

        $tcon_show_currency = true;
        if ($receipt_printer_type == 'printer' && trim($moneda->simbolo) != '$') {
            $tcon_show_currency = false;
        }

        $output['lines'] = [];
        $details = self::detalleTicket($detalle, $moneda);
        $output['lines'] = $details;

        $output['promocion_label'] = '';
        if($transaction->tic_promocion == '1')
        {
            $promocion = self::promocionTicket($transaction->tic_promocion);
            $output['promocion_label'] = $promocion;
        }
            $output['total_label'] =  'Total :';
            $output['total'] = Util::num_f($transaction->tic_apostado, $moneda);


            $output['estado_label'] = '';
            $estado = self::estadoTicket($transaction->tic_estado);
            $output['estado_label'] = $estado;


        //Check for barcode
        $output['barcode'] = ($il->tcon_show_barcode == 1) ? $transaction->tic_ticket : false;

        //Additional notes
        $output['footer_text'] = $il->tcon_ticket_mensaje;

        //Barcode related information.
        $output['tcon_show_barcode'] = !empty($il->tcon_show_barcode) ? true : false;

        if ($il->tcon_show_nota == 1) {
            $output['tcon_nota_informativa'] = $il->tcon_nota_informativa;
        }

        return (object) $output;
    }

    public static function detalleTicket($detalles, $moneda)
    {
        $arrayQ = array();
        $arrayPL = array();
        $arrayTP = array();
        $arraySP = array();

        foreach ($detalles as $detalle) {

            if ($detalle->mod_codigo == '1') {
                $arrayQ[] = $detalle;
            }
            if ($detalle->mod_codigo == '2') {
                $arrayPL[] = $detalle;
            }
            if ($detalle->mod_codigo == '3') {
                $arrayTP[] = $detalle;
            }
            if ($detalle->mod_codigo == '4') {
                $arraySP[] = $detalle;
            }
        }

        $output = '';
        if (count($arrayQ)  != 0) {
            // $output .=  self::drawLine();
            $output .=  "<div class='flex-box border-top'><strong>Quiniela</strong></div>";
            foreach ($arrayQ as $numeros) {
                $valor =  Util::num_f($numeros->tid_valor, $moneda);

                if ($numeros->tid_ganado != 0) {
                    $clase =  'badge-success';
                } else {
                    $clase =  '';
                }

                $output .=
                    "<div class='textbox-info'>" .
                    "<p class='f-left $clase' >$numeros->tid_apuesta</p>" .
                    "<p class='f-right'>$valor</p>" .
                    "</div>";
            }
            // $output .=  self::drawLine();
        }
        if (count($arrayPL)  != 0) {
            $output .=  "<div class='flex-box border-top'><strong>Pales</strong></div>";
            foreach ($arrayPL as $numeros) {
                $valor =  Util::num_f($numeros->tid_valor, $moneda);

                if ($numeros->tid_ganado != 0) {
                    $clase =  'badge-success';
                } else {
                    $clase =  '';
                }

                $output .=
                    "<div class='textbox-info'>" .
                    "<p class='f-left $clase' >$numeros->tid_apuesta</p>" .
                    "<p class='f-right'>$valor</p>" .
                    "</div>";
            }
            // $output .=  self::drawLine();
        }
        if (count($arrayTP)  != 0) {

            $output .=  "<div class='flex-box border-top'><strong>Tripletas</strong></div>";
            foreach ($arrayTP as $numeros) {
                $valor =  Util::num_f($numeros->tid_valor, $moneda);

                if ($numeros->tid_ganado != 0) {
                    $clase =  'badge-success';
                } else {
                    $clase =  '';
                }

                $output .=
                    "<div class='textbox-info'>" .
                    "<p class='f-left $clase' >$numeros->tid_apuesta</p>" .
                    "<p class='f-right'>$valor</p>" .
                    "</div>";
            }

            // $output .=  self::drawLine();
        }
        if (count($arraySP)  != 0) {
            $output .=  self::drawLine();
            $output .=  "<div class='flex-box border-top'><strong>SuperPale</strong></div>";
            foreach ($arraySP as $numeros) {
                $valor =  Util::num_f($numeros->tid_valor, $moneda);

                if ($numeros->tid_ganado != 0) {
                    $clase =  'badge-success';
                } else {
                    $clase =  '';
                }

                $output .=
                    "<div class='textbox-info'>" .
                    "<p class='f-left $clase'>$numeros->tid_apuesta</p>" .
                    "<p class='f-right'>$valor</p>" .
                    "</div>";
            }

            // $output .=  self::drawLine();
        }



        return $output;
    }

    public static function promocionTicket($promocion)
    {
        $output = '';
        if($promocion == 1){
        $output .=
            "<div class='centered'>" .
            "<p>*****************************</p>" .
            "<p>**       PROMOCION         **</p>" .
            "<p>*****************************</p>" .
            "</div>";
        }
        return $output;
    }

    public static function estadoTicket($estado)
    {

        $output = '';
        if ($estado == 0) {
            $output .=
                "<div class='centered'>" .
                "<p>*****************************</p>" .
                "<p>**       ANULADO           **</p>" .
                "<p>*****************************</p>" .
                "</div>";
        }elseif($estado == 2){
            $output .=
                "<div class='centered'>" .
                "<p>*****************************</p>" .
                "<p>**       PREMIADO          **</p>" .
                "<p>*****************************</p>" .
                "</div>";
        }
        elseif($estado == 3){
            $output .=
                "<div class='centered'>" .
                "<p>*****************************</p>" .
                "<p>**       PAGADO            **</p>" .
                "<p>*****************************</p>" .
                "</div>";
        }


        return $output;
    }

    public static function drawLine()
    {
        $char_per_line = 50 ;
        $new = '';
        for ($i = 1; $i < $char_per_line; $i++) {
            $new .= '-';
        }
        return $new . "\n";
    }


    /**
     * Devuelve el contenido del recibo
     *
     * @param  int  $empresas_id
     * @param  int  $bancas_id
     * @param  int  $tickets
     * @param string $printer_type = null
     *
     * @return array
     */
    public static function receiptContent(
        $empresas_id,
        $tickets,
        $bancas_id,
        $detalle,
        $isAnular,
        $receipt_printer_type = null

    ) {

        $marketService = resolve(MarketService::class);

        $empresas_detalle = $marketService->getEmpresaDetalle($empresas_id);

        $moneda = $marketService->getEmpresaMoneda($empresas_id);

        $banca = $marketService->getBanca( !empty($bancas_id) ? $bancas_id : $tickets[0]->bancas_id);

        $invoice_layout = BancaUtil::invoiceLayout($empresas_id,   !empty($banca->app_config_tickets_id) ? $banca->app_config_tickets_id : null);


        $detalle_ticket = self::getReceiptDetails($tickets, $invoice_layout, $empresas_detalle, $moneda, $banca, $receipt_printer_type, $detalle, $isAnular);

        return $detalle_ticket;
    }
}
