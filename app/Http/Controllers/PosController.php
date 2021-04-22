<?php

namespace App\Http\Controllers;

use App\Services\MarketService;
use App\Utils\Tickets;
use App\Utils\Util;
use App\Utils\HorarioLoterias;
use Illuminate\Http\Request;

use App\Utils\BancaUtil;
use App\Utils\Reportes;
use App\Utils\TransactionUtil;
use Carbon\Carbon;

class PosController extends Controller
{
    protected $util;
    protected $bancaUtil;
    protected $transactionUtil;
    protected $marketService;

    /**
     * Constructor
     *
     * @param ProductUtils $product
     * @return void
     */
    public function __construct(
        Util $util,
        BancaUtil $bancaUtil,
        TransactionUtil $transactionUtil,
        MarketService $marketService
    ) {
        $this->util = $util;
        $this->bancaUtil = $bancaUtil;
        $this->transactionUtil = $transactionUtil;
        $this->middleware('auth');
        parent::__construct($marketService);

    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $empresas_id = session()->get('user.emp_id');

        $tickets = $this->marketService->getTicketsEmpresa($empresas_id);
        $loterias =  Reportes::getloteriasEmpresaReporte($empresas_id);
        $bancas = $this->bancaUtil->forDropdown($empresas_id);
        $estadosTicket = Util::estadosTicket();
        $estadosPromocionTicket = Util::estadosPromocionTicket();
        return view('sale_pos.index')->with(['tickets' => $tickets, 'loterias' => $loterias, 'bancas' => $bancas, 'estadosTicket' => $estadosTicket, 'estadosPromocionTicket'=> $estadosPromocionTicket]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $fecha = HorarioLoterias::fechaActual();
        $dia = HorarioLoterias::dia($fecha);
        $horaRD = HorarioLoterias::horaRD();

        $bancas_id = request()->session()->get('user.banca');
        $symbol = request()->session()->get('currency.symbol');

        $loterias = $this->marketService->getHorarioLoteriasBanca($bancas_id, $dia);
        $parametros =  $this->marketService->getParametrosBanca($bancas_id);

        return view('sale_pos.create')->with(['loterias' => $loterias, 'symbol' => $symbol, 'horaRD' => $horaRD, 'parametros' => $parametros]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $empresas_id =  request()->session()->get('user.emp_id');
        $bancas_id =  request()->session()->get('user.banca');
        $users_id =  request()->session()->get('user.id');


        $data['empresas_id'] =  $empresas_id;
        $data['users_id'] =  $users_id;
        $data['bancas_id'] =  $bancas_id;
        $data['tic_numeros'] = $request->product_row;
        $data['loterias_id']  = $request->loterias_id;
        $data['tic_fecha_sorteo']  = $request->tic_fecha_sorteo ? carbon::createFromFormat('d/m/Y', $request->tic_fecha_sorteo)->format('Y-m-d') :Carbon::now()->format('Y-m-d');
        $data['tic_promocion']  = $request->tic_promocion;

        $ticket_promocion_show = $this->util->ticketPromocionShow();

        foreach ($ticket_promocion_show as  $key => $value) {
            if (!isset($data[$key])) {
                $data[$key] = $value;
            }
        }


        $data = $this->marketService->postNuevoTicket($data);


        $receipt = '';
        $mensaje = 'Venta añadida con éxito';

        $output = ['success' => 1, 'mensaje' => $mensaje, 'receipt' => $data];


        return $output;

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
    private function receiptContent(
        $empresas_id,
        $tickets_id,
        $bancas_id,
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
        $invoice_layout = $this->bancaUtil->invoiceLayout($empresas_id, $bancas_id, $banca->app_config_tickets_id);


        //Compruebe si se proporciona la configuración de la impresora.
        $receipt_printer_type = is_null($printer_type) ? $banca->ban_tipo_impresora : $printer_type;

        $detalle_ticket = $this->transactionUtil->getReceiptDetails($tickets_id, $bancas_id, $invoice_layout, $empresas_detalle, $moneda, $banca, $receipt_printer_type);


        $currency_details = [
            'symbol' => $moneda->simbolo,
            'thousand_separator' => $moneda->separador_miles,
            'decimal_separator' => $moneda->separador_decimal
        ];


        //Si el tipo de impresión es navegador: devuelve el contenido, impresora: devuelve los datos de configuración de la impresora y la configuración del formato de factura
        if ($receipt_printer_type == 'printer') {
            $output['print_type'] = 'printer';
            $output['printer_config'] = $this->bancaUtil->printerConfig($empresas_id, $banca->impresoras_pos_id);
            $output['data'] = $detalle_ticket;

        } else {

            //    $layout = !empty($detalle_ticket->design) ? 'sale_pos.receipts.' . $detalle_ticket->design : 'sale_pos.receipts.slim';
            $layout =  'sale_pos.receipts.slim';
            $output['html_content'] = view($layout, compact('detalle_ticket'))->render();
        }

        return $output;
    }

    public function getHorarioLoteriasDia(Request $request)
    {
        if ($request->ajax()) {

            $empresas_id = session()->get('user.emp_id');
            $dia = HorarioLoterias::dia(now());

            $horaRD = HorarioLoterias::horaRD();
            $horarioLoteria = HorarioLoterias::getHorarioLoteriasDia($empresas_id, $dia);

            $output = '';

            foreach ($horarioLoteria as $key => $detalle) {
                // dd($detalle->hlo_hora_fin, $horaRD);
                $horariocierre = HorarioLoterias::compararHoras($detalle->hlo_hora_fin, $horaRD);

                if($horariocierre == 0){
                              $output .=  '<div class="col-6 col-sm-6 col-md-6 col-lg-4 col-xl-4">
                                <div class="icheck-material-success">
                                    <input type="checkbox" id="' . $detalle->lot_nombre . '" name="lot_id[]" value="'. $detalle->loterias_id . '"/>
                                    <label class="validar" for="'. $detalle->lot_nombre . '"><span class="badge badge-success m-1 "><h6 class="text-white">' . $detalle->lot_nombre . '</h6></span></label>
                                </div>
                            </div>';
                 } else{
                    $output .=  '<div class="col-6 col-sm-6 col-md-6 col-lg-4 col-xl-4">
                                <div class="icheck-material-danger">
                                    <input type="checkbox" id="' . $detalle->lot_nombre . '" disabled/>
                                    <label class="validar" for="' . $detalle->lot_nombre . '"><span class="badge badge-danger m-1"><h6 class="text-white">' . $detalle->lot_nombre . '</h6></span></label>
                                </div>
                            </div>';
                 }

            }
            return $output;
        }
    }

    /**
     * Checks if ref_number and supplier combination already exists.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function printTicket($tickets_id)
    {

        if (request()->ajax()) {
            try {
                $output = [
                    'success' => 0,
                    'msg' => "Algo salió mal, por favor intente de nuevo más tarde"
                ];

                $empresas_id = session()->get('user.emp_id');
                $bancas_id =  session()->get('user.banca');

                $receipt = $this->marketService->getGenerarTicket($empresas_id, $tickets_id, $bancas_id );
                // dd($receipt);


                if (!empty($receipt)) {
                    $output = ['success' => 1, 'receipt' => $receipt];
                }
            } catch (\Exception $e) {
                \Log::emergency("File:" . $e->getFile() . "Line:" . $e->getLine() . "Message:" . $e->getMessage());

                $output = [
                    'success' => 0,
                    'msg' => "Algo salió mal, por favor intente de nuevo más tarde"
                ];
            }

            return $output;
        }
    }
}
