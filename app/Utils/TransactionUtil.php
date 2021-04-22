<?php

namespace App\Utils;

use App\Services\MarketService;
class TransactionUtil extends Util
{



    /**
     * Gives the receipt details in proper format.
     *
     * @param int $tickets_id
     * @param int $location_id
     * @param object $invoice_layout
     * @param array $empresas_detalle
     * @param array $receipt_details
     * @param string $receipt_printer_type
     *
     * @return array
     */
    public function getReceiptDetails($tickets_id, $invoice_layout, $empresas_detalle, $moneda, $location_details, $receipt_printer_type)
    {
        // dd($tickets_id, $location_id, $invoice_layout, $empresas_detalle, $moneda, $location_details, $receipt_printer_type);
        $marketService = resolve(MarketService::class);
        $il = $invoice_layout;


        $transaction = $marketService->getTicket($tickets_id);


        $output = [
            'slogan' => isset($il->slogan) ? $il->slogan : '',
            'business_name' => ($il->show_business_name == 1) ? $empresas_detalle[0]->emp_nombre : '',
            'location_name' => ($il->show_location_name == 1) ? $location_details->ban_nombre : '',
            'loteria' => $transaction[0]->lot_nombre,
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
        // $output['logo'] = $il->show_logo != 0 && !empty($il->logo) && file_exists(public_path('uploads/invoice_logos/' . $il->logo)) ? asset('uploads/invoice_logos/' . $il->logo) : false;
        if ($il->show_logo == 1) {
            $output['logo']  = $il->logo;
        }
        //$output['logo'] = $il->logo == 1 && !empty($il->logo) && file_exists(public_path('uploads/invoice_logos/' . $il->logo)) ? asset('uploads/invoice_logos/' . $il->logo) : false;

        //Address
        $output['address'] = '';
        $temp = [];
        if ($il->show_city == 1 &&  !empty($location_details->city)) {
            $temp[] = $location_details->city;
        }
        if ($il->show_state == 1 &&  !empty($location_details->state)) {
            $temp[] = $location_details->state;
        }
        if ($il->show_zip_code == 1 &&  !empty($location_details->zip_code)) {
            $temp[] = $location_details->zip_code;
        }
        if ($il->show_country == 1 &&  !empty($location_details->country)) {
            $temp[] = $location_details->country;
        }
        if (!empty($temp)) {
            $output['address'] .= implode(',', $temp);
        }

        $output['website'] = $location_details->ban_website;


        //Información de contacto de la tienda
        $output['contact'] = '';
        if ($il->show_mobile_number == 1 && !empty($location_details->mobile)) {
            $output['contact'] .= 'Mobile: ' . $location_details->mobile;
        }
        if ($il->show_alternate_number == 1 && !empty($location_details->alternate_number)) {
            if (empty($output['contact'])) {
                $output['contact'] .= 'Mobile: ' . $location_details->alternate_number;
            } else {
                $output['contact'] .= ', ' . $location_details->alternate_number;
            }
        }
        if ($il->show_email == 1 && !empty($location_details->email)) {
            if (!empty($output['contact'])) {
                $output['contact'] .= "\n";
            }
            $output['contact'] .= 'Email: ' . $location_details->email;
        }

        //Información del ticket
        $output['invoice_no'] = $transaction[0]->tic_ticket;
        $output['pin_no'] = $transaction[0]->tic_pin;


        $output['invoice_no_prefix'] = $il->etiqueta_ticket;
        $output['invoice_eslogan'] = $il->slogan;
        $output['pin_no_prefix'] = $il->etiqueta_pin;


        $output['date_label'] = $il->date_label;
        $output['invoice_date'] = \Carbon::createFromFormat('Y-m-d H:i:s', $transaction[0]->updated_at)->format($il->date_time_format);


        $show_currency = true;
        if ($receipt_printer_type == 'printer' && trim($moneda->simbolo) != '$') {
            $show_currency = false;
        }

        $output['lines'] = [];
        $lines = $marketService->getTicketDetalle($tickets_id);

        $details = $this->_receiptDetailsSellLines($lines, $moneda);

        $output['lines'] = $details['lines'];


        $output['total_label'] =  'Total :';
        $output['total'] = $this->num_f($transaction[0]->tic_apostado, $moneda);


        //Check for barcode
        $output['barcode'] = ($il->show_barcode == 1) ? $transaction[0]->tic_ticket : false;

        //Additional notes
        $output['footer_text'] = $invoice_layout->ticket_mensaje;

        //Barcode related information.
        $output['show_barcode'] = !empty($il->show_barcode) ? true : false;

        return (object) $output;
    }

    /**
     * Returns each line details for sell invoice display
     *
     * @return array
     */
    protected function _receiptDetailsSellLines($lines, $empresas_detalle)
    {

        foreach ($lines as $line) {

            $apuesta = $line->tid_apuesta;
            $valor = $line->tid_valor;
            $modalidad = $line->modalidades_id;

            $line_array = [

                'modalidad' => $modalidad,
                'apuesta' => $apuesta,
                'valor' => $this->num_f($valor, false, $empresas_detalle, true),

            ];

            //If modifier is set set modifiers line to parent sell line

            $output_lines[] = $line_array;
        }

        return ['lines' => $output_lines];
    }

}
