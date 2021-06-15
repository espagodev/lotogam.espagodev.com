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
        $usuarios =  $this->marketService->getUsuariosEmpresa($empresas_id);

        return view('sale_pos.index')->with(['tickets' => $tickets, 'loterias' => $loterias, 'bancas' => $bancas, 'estadosTicket' => $estadosTicket, 'estadosPromocionTicket' => $estadosPromocionTicket, 'usuarios' => $usuarios]);
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
        $fechaActual = now()->format('d/m/Y');

        return view('sale_pos.create')->with(['loterias' => $loterias, 'symbol' => $symbol, 'horaRD' => $horaRD, 'parametros' => $parametros, 'fechaActual' => $fechaActual]);
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
        $data['tic_fecha_sorteo']  = $request->tic_fecha_sorteo ? carbon::createFromFormat('d/m/Y', $request->tic_fecha_sorteo)->format('Y-m-d') : Carbon::now()->format('Y-m-d');
        $data['tic_promocion']  = $request->tic_promocion;

        $ticket_promocion_show = $this->util->ticketPromocionShow();

        foreach ($ticket_promocion_show as  $key => $value) {
            if (!isset($data[$key])) {
                $data[$key] = $value;
            }
        }

        $ticket = $this->marketService->postNuevoTicket($data);
        $tickets = $ticket->ticket;

        foreach ($tickets as $ticket) {
            $receipt[] = $this->receiptContent($empresas_id, $bancas_id, $ticket, null, false, true );
            $mensaje = 'Venta añadida con éxito';
            $output = ['success' => 1, 'mensaje' => $mensaje, 'receipt' => $receipt];
        }
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
        $bancas_id,
        $tickets_id,
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

        $tickets = $this->marketService->getTicket($tickets_id);
        $ticketDetalle = $this->marketService->getTicketDetalle($tickets_id);

        // if ($from_pos_screen && $banca->ban_imprimir_recibo != 1) {
        //     return $output;
        // }

        //Compruebe si la impresión de factura está habilitada o no.
        // Si está habilitado, obtenga el tipo de impresión.
        $output['is_enabled'] = true;

        $invoice_layout_id = !empty($invoice_layout_id) ? $invoice_layout_id : $banca->app_config_tickets_id;
        $invoice_layout = $this->bancaUtil->invoiceLayout($empresas_id, $banca->app_config_tickets_id);

        //Compruebe si se proporciona la configuración de la impresora.
        $receipt_printer_type = is_null($printer_type) ? $banca->ban_tipo_impresora : $printer_type;

        //calcular el tiempo de anular
        $isAnular = Util::calcularMinutos($tickets[0]->created_at, $banca->ban_tiempo_anular);

        $detalle_ticket = $this->transactionUtil->getReceiptDetails($tickets_id, $tickets, $invoice_layout, $empresas_detalle, $moneda, $banca, $receipt_printer_type, $ticketDetalle, $isAnular);

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
            $output['print'] = "ticket";
        } else {

            $layout = !empty($invoice_layout->tcon_formato_browser) ? 'sale_pos.receipts.' . $invoice_layout->tcon_formato_browser : 'sale_pos.receipts.classic';
            $output['html_content'] = view($layout, compact('detalle_ticket', 'isAnular'))->render();
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

                if ($horariocierre == 0) {
                    $output .=  '<div class="col-6 col-sm-6 col-md-6 col-lg-4 col-xl-4">
                                <div class="icheck-material-success">
                                    <input type="checkbox" id="' . $detalle->lot_nombre . '" name="lot_id[]" value="' . $detalle->loterias_id . '|' . 0 . '"/>
                                    <label class="validar_monto"  for="' . $detalle->lot_nombre . '"  data-loteria="' . $detalle->lot_nombre . '" data-loterias_id="' . $detalle->loterias_id . '"  data-superpale="0"><span class="badge badge-success m-1 validar-monto"><h6 class="text-white">' . $detalle->lot_nombre . '</h6></span></label>
                                </div>
                            </div>';
                } else {
                    $output .=  '<div class="col-6 col-sm-6 col-md-6 col-lg-4 col-xl-4">
                                <div class="icheck-material-danger">
                                    <input type="checkbox" id="' . $detalle->lot_nombre . '" disabled/>
                                    <label  for="' . $detalle->lot_nombre . '"><span class="badge badge-danger m-1"><h6 class="text-white">' . $detalle->lot_nombre . '</h6></span></label>
                                </div>
                            </div>';
                }
            }
            return $output;
        }
    }

    public function getLoteriasSuperPale(Request $request)
    {
        if ($request->ajax()) {

            $empresas_id = session()->get('user.emp_id');
            $dia = HorarioLoterias::dia(now());

            $horaRD = HorarioLoterias::horaRD();
            $horarioLoteria = HorarioLoterias::getLoteriasSuperPaleDia($empresas_id, $dia);

            $output = '';
            foreach ($horarioLoteria as $key => $detalle) {
                // dd($detalle->hlo_hora_fin, $horaRD);
                $horariocierre = HorarioLoterias::compararHoras($detalle->hlo_hora_fin, $horaRD);

                if ($horariocierre == 0) {
                    $output .=  '<div class="col-6 col-sm-6 col-md-6 col-lg-4 col-xl-4">
                                <div class="icheck-material-info">
                                    <input type="checkbox" id="' . $detalle->lot_nombre . '" name="lot_id[]" value="' . $detalle->loterias_id . '|' . $detalle->lot_superpale . '"/>
                                    <label class="validar_monto" for="' . $detalle->lot_nombre . '" data-loteria="' . $detalle->lot_nombre . '" data-loterias_id="' . $detalle->loterias_id . '" data-superpale="' . $detalle->lot_superpale . '" ><span class="badge badge-info m-1 "><h6 class="text-white">' . $detalle->lot_nombre . '</h6></span></label>
                                </div>
                            </div>';
                } else {
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
                // dd($bancas_id);


                $banca = $this->marketService->getBanca($bancas_id);
                $invoice_layout = $this->bancaUtil->invoiceLayout($empresas_id, $bancas_id, $banca->app_config_tickets_id);

                $printer_type = 'browser';
                if (!empty(request()->input('check_location')) && request()->input('check_location') == true) {

                    //Compruebe si se proporciona la configuración de la impresora.
                    $printer_type = is_null($printer_type) ? $banca->ban_tipo_impresora : $printer_type;
                }

                $invoice_layout_id = !empty($invoice_layout_id) ? $invoice_layout_id : $banca->app_config_tickets_id;
                $invoice_layout = $this->bancaUtil->invoiceLayout($empresas_id, $bancas_id, $banca->app_config_tickets_id);

                $receipt = $this->receiptContent($empresas_id, $bancas_id, $tickets_id, $printer_type, false, $invoice_layout);


                if (!empty($receipt)) {
                    $output = ['success' => 1, 'receipt' => $receipt];
                }
            } catch (\Exception $e) {
                \Log::emergency("File:" . $e->getFile() . "Line:" . $e->getLine() . "Message:" . $e->getMessage());

                $output = [
                    'success' => 0,
                    'msg' => "Algo salió mal, por favor intente de nuevo más tarde aqui"
                ];
            }

            return $output;
        }
    }
}
