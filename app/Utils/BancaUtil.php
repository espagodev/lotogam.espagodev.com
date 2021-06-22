<?php

namespace App\Utils;


use App\Services\MarketService;
use Carbon\Carbon;

class BancaUtil
{


    public static function parametrosBanca($bancas_id){

        $marketService = resolve(MarketService::class);

        $parametrosBanca = $marketService->getParametrosBanca($bancas_id);

        return $parametrosBanca;
    }

    /**
     * Return the printer configuration
     *
     * @param int $business_id
     * @param int $printer_id
     *
     * @return array
     */
    public function printerConfig($empresas_id, $printer_id)
    {
        $marketService = resolve(MarketService::class);

        $printer =  $marketService->getImpresoraDetalle($empresas_id, $printer_id);

        $output = [];

        if (!empty($printer)) {
            $output['connection_type'] = $printer->connection_type;
            $output['capability_profile'] = $printer->capability_profile;
            $output['char_per_line'] = $printer->char_per_line;
            $output['ip_address'] = $printer->ip_address;
            $output['port'] = $printer->port;
            $output['path'] = $printer->path;
            // $output['server_url'] = $printer->server_url;
        }

        return $output;
    }

    /**
     * Devolver los detalles del diseño de la factura
     *
     * @param int $business_id
     * @param array $location_details
     * @param array $layout_id = null
     *
     * @return location object
     */
    public static function invoiceLayout($empresas_id,  $layout_id)
    {
        $marketService = resolve(MarketService::class);

        $layout = $marketService->getAppConfigTickets($empresas_id, $layout_id);

        return $layout;
    }

    /**
     * Return the default setting for the pos screen.
     *
     * @return array
     */
    public function defaultPosSettings()
    {
        return ['disable_pay_checkout' => 0, 'disable_draft' => 0, 'disable_express_checkout' => 0, 'hide_product_suggestion' => 0, 'hide_recent_trans' => 0, 'disable_discount' => 0, 'disable_order_tax' => 0, 'is_pos_subtotal_editable' => 0];
    }

    /**
     * Return the default setting for the email.
     *
     * @return array
     */
    public function defaultEmailSettings()
    {
        return ['mail_host' => '', 'mail_port' => '', 'mail_username' => '', 'mail_password' => '', 'mail_encryption' => '', 'mail_from_address' => '', 'mail_from_name' => ''];
    }

    /**
     * Return the default setting for the sms.
     *
     * @return array
     */
    public function defaultSmsSettings()
    {
        return ['url' => '', 'send_to_param_name' => 'to', 'msg_param_name' => 'text', 'request_method' => 'post', 'param_1' => '', 'param_val_1' => '', 'param_2' => '', 'param_val_2' => '','param_3' => '', 'param_val_3' => '','param_4' => '', 'param_val_4' => '','param_5' => '', 'param_val_5' => '', ];
    }


    /**
     * Devolver lista de bancas para una empresa
     *
     * @param int $empresas_id
     *
     * @return array
     */
    public static function forDropdown($empresas_id)
    {
        $marketService = resolve(MarketService::class);

        $query =  $marketService->getListaBancaEmpresa($empresas_id);

        $locations = $query;

        return $locations;

    }


    //DIA ACTUAL
    public static function tiempoAnular()
    {
        $tiempoAnular = '5';

        return  $tiempoAnular;
    }


    /**
     * @param string $fecha_creacion
     */
    static function calcularMinutos($fecha_creacion )
    {
        $created = new Carbon($fecha_creacion);
        $now =  Carbon::now()->toDateTimeString();


        if ($created->diffInMinutes($now) > self::tiempoAnular()) {
            return 1;
        } else {
            return 0;
        }
    }


    public static function htmlContent($receipt) {

        // $layout = !empty($receipt_details->design) ? 'sale_pos.receipts.' . $receipt_details->design : 'sale_pos.receipts.classic';
        $receipt = $receipt[0]->data;
        // dd($receipt);
        $output['html_content'] = view('sale_pos.receipts.classic', compact('receipt'))->render();

        return $output;
    }
}
