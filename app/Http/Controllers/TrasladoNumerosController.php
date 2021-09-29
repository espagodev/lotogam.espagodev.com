<?php

namespace App\Http\Controllers;

use App\Services\MarketService;
use App\Utils\BancaUtil;
use App\Utils\FormatoTrasladoUtil;
use App\Utils\Reportes;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class TrasladoNumerosController extends Controller
{
    public function __construct(MarketService $marketService)
    {
        $this->middleware('auth');

        parent::__construct($marketService);
    }

    public function index(Request $request)
    {
       
        $empresas_id = session()->get('user.emp_id');

        $bancas = BancaUtil::forDropdown($empresas_id);
        $loterias =  Reportes::getloteriasEmpresaReporte($empresas_id);
        $traslado =  $this->marketService->getNumerosTrasladoActivo($empresas_id);
        $modalidades =  $this->marketService->getModalidades();

        return view('trasladoNumeros.index')->with(['loterias' => $loterias,'bancas' => $bancas, 'traslado' => $traslado, 'modalidades' =>$modalidades]);

    }


     public function getReporteTrasladoNumeros(Request $request)
    {

            $data = $request->only(['start_date', 'end_date',  'loterias_id',  'modalidades_id']);
            $data['empresas_id'] = session()->get('user.emp_id');
            
        $reporteJugadas = $this->marketService->getReporteTrasladoNumeros($data);

        if ($request->ajax()) {
        return $datatable = DataTables::of($reporteJugadas)

        ->editColumn('tln_fecha', '{{@format_date($tln_fecha)}}')

        ->addColumn('action', function ($row) {
            return  '<input type="input" class="tln_contador_traslado input-small" id="tln_contador_traslado_'. $row->id .'" data-id="' . $row->id .'" value="">' ;
        })
        ->rawColumns(['tln_fecha','action'])
        ->make(true);
        }

    }

    public function getPrintReporteTrasladoNumeros(Request $request)
    {

        if (request()->ajax()) {
            try {
                $output = [
                    'success' => 0,
                    'msg' => "Algo salió mal, por favor intente de nuevo más tarde"
                ];

                if (session()->get('user.TipoUsuario') == 2) {  
                    $data = $request->only(['start_date', 'end_date',  'loterias_id', 'users_id', 'estado', 'promocion', 'modalidades_id',  'bancas_id']);
                } else if (session()->get('user.TipoUsuario') == 3) {
                    $data = $request->only(['start_date', 'end_date',  'loterias_id','modalidades_id']);
                    $data['bancas_id'] = !empty($request->bancas_id) ? $request->bancas_id : session()->get('user.banca');
                    $data['users_id'] = !empty($request->users_id) ? $request->users_id : session()->get('user.id');
                }
                $data['empresas_id'] = session()->get('user.emp_id');
              
                // $invoice_layout = $this->marketService->getAppConfigTicketsEmpresa($data['empresas_id']);
      
                // $printer_type = 'browser';

                // $receipt = $this->reportContent($data['empresas_id'],  $printer_type, false, $invoice_layout[0]);
                $trasladoNUmeros = $this->marketService->getReporteTrasladoNumeros($data);
             

                $formatoPdf = FormatoTrasladoUtil::HtmlContent($trasladoNUmeros);

                $output = ['success' => 1, 'receipt' => $formatoPdf];

            } catch (\Exception $e) {
                \Log::emergency("File:" . $e->getFile() . "Line:" . $e->getLine() . "Message:" . $e->getMessage());

                $output = [
                    'success' => 0,
                    'msg' => "Algo salió mal, Error al imprimir"
                ];
            }

            return $output;
        }
    }

    public function trasladar(Request $request, $traslado ){ 

     
        $data['traslado_id'] = $traslado;
        $data['empresas_id'] = session()->get('user.emp_id');
        $data['tln_contador_traslado'] =  $request->input('tln_contador_traslado');

         $traslado =  $this->marketService->modificarTraslado($data);

         return json_encode($traslado);
    }

        /**
     * Devuelve el contenido del recibo
     *
     * @param  int  $empresas_id
     * @param  int  $bancas_id
     * @param  int  $tickets_id
     * @param string $printer_type = null
     *
     * @return array
     */
    private function reportContent(
        $empresas_id,

        $printer_type = null,
        $from_pos_screen = true,
        $invoice_layout_id = null

    ) {
        $output = [
            'is_enabled' => false,
            'print_type' => 'browser',
            'html_content' => null,
            'printer_config' => [],
            'data' => []
        ];

        $empresas_detalle = $this->marketService->getEmpresaDetalle($empresas_id);
        $moneda = $this->marketService->getEmpresaMoneda($empresas_id);

        //informacion de la impresora
        $banca = $this->marketService->getBanca($bancas_id);


        $output['is_enabled'] = true;

        $invoice_layout_id = !empty($invoice_layout_id) ? $invoice_layout_id : $banca->app_config_tickets_id;
        $invoice_layout = $this->bancaUtil->invoiceLayout($empresas_id, $banca->app_config_tickets_id);

        //Compruebe si se proporciona la configuración de la impresora.
        $receipt_printer_type = is_null($printer_type) ? $banca->ban_tipo_impresora : $printer_type;

        //calcular el tiempo de anular

        foreach ($tickets as $ticketIndi) {
            $ticket = $this->marketService->getTicket($ticketIndi);

            $ticketDetalle = $this->marketService->getTicketDetalle($ticketIndi);

           

            $detalle_ticket[] = $this->transactionUtil->getReceiptDetails($ticketIndi, $ticket, $invoice_layout, $empresas_detalle, $moneda, $banca, $receipt_printer_type, $ticketDetalle);
        }

        $currency_details = [
            'symbol' => $moneda->simbolo,
            'thousand_separator' => $moneda->separador_miles,
            'decimal_separator' => $moneda->separador_decimal
        ];

        //Si el tipo de impresión es navegador: devuelve el contenido, impresora: devuelve los datos de configuración de la impresora y la configuración del formato de factura
        // if ($receipt_printer_type == 'printer') {
        //     $output['print_type'] = 'printer';
        //     $output['printer_config'] = $this->bancaUtil->printerConfig($empresas_id, $banca->impresoras_pos_id);
        //     $output['data'] = $detalle_ticket;
        //     $output['print'] = "ticket";
        // } else {

            $layout = !empty($invoice_layout->tcon_formato_browser) ? 'sale_pos.receipts.' . $invoice_layout->tcon_formato_browser : 'sale_pos.receipts.classic';
            $output['html_content'] = view($layout, compact('detalle_ticket', 'isAnular'))->render();
        // }

        return $output;
    }

}
