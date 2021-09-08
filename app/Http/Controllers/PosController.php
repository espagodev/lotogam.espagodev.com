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
use App\Utils\CajaRegistradoraUtil;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;

class PosController extends Controller
{
    protected $util;
    protected $bancaUtil;
    protected $transactionUtil;
    protected $cajaRegistradoraUtil;
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
        CajaRegistradoraUtil $cajaRegistradoraUtil,
        MarketService $marketService
    ) {
        $this->util = $util;
        $this->bancaUtil = $bancaUtil;
        $this->cajaRegistradoraUtil = $cajaRegistradoraUtil;
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
        // try {

            // Compruebe si está suscrito o no, luego verifique la cuota de usuarios
            // if (!$this->moduleUtil->isSubscribed($business_id)) {
            //     return $this->moduleUtil->expiredResponse(action('HomeController@index'));
            // } elseif (!$this->moduleUtil->isQuotaAvailable('invoices', $business_id)) {
            //     return $this->moduleUtil->quotaExpiredResponse('invoices', $business_id, action('SellPosController@index'));
            // }

            // Verifique si hay un registro abierto, si no es así, redirija a la pantalla Crear registro.
            $totalCajasAbiertas = CajaRegistradoraUtil::totalCajasAbiertas();

        if ($totalCajasAbiertas[0] == 0) {
            return redirect()->action('CajaRegistradoraController@create');
        }

        $fecha = HorarioLoterias::fechaActual();
        // $fecha = carbon::createFromFormat('d/m/Y', $fechaCalculada)->tz('America/Santo_Domingo')->format('Y-m-d H:i:s');
        $dia = HorarioLoterias::dia();
        $horaRD = HorarioLoterias::horaRD();

        $bancas_id = request()->session()->get('user.banca');
        // $users_id = session()->get('user.id');
        $symbol = request()->session()->get('currency.symbol');
        // $limite_venta = session()->get('banca.limite_venta');

      
        $parametros =  $this->marketService->getParametrosBanca($bancas_id);
        
        $fechaActual = Carbon::now()->tz('America/Santo_Domingo')->format('d/m/Y');

            return view('sale_pos.create')->with([               
                'symbol' => $symbol,
                'parametros' => $parametros,
                'fechaActual' => $fechaActual,

            ]);

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

        // $data['tic_fecha_sorteo']  =  $request->tic_fecha_sorteo ? carbon::createFromFormat('d/m/Y', $request->tic_fecha_sorteo)->format('Y-m-d') : Carbon::now()->format('Y-m-d');
        $data['tic_fecha_sorteo']  =  !empty($request->tic_fecha_sorteo) ? Carbon::createFromFormat('d/m/Y', $request->tic_fecha_sorteo, 'America/Santo_Domingo')->format('Y-m-d H:i:s') : (new Carbon(date('Y-m-d H:i:s')))->tz('America/Santo_Domingo')->format('Y-m-d H:i:s');
        $data['tic_promocion']  = $request->tic_promocion;
        $ticket_promocion_show = $this->util->ticketPromocionShow();

        foreach ($ticket_promocion_show as  $key => $value) {
            if (!isset($data[$key])) {
                $data[$key] = $value;
            }
        }

        $validarHoracierreLoteria = Util::validarHoracierreLoteria($request->loterias_id);
        // dd($validarHoracierreLoteria);
        if ($validarHoracierreLoteria) {
            return  $output = ['error' => 1, 'mensaje' => 'La Loteria no Esta Disponible Para Realizar Jugadas'];
        }
        // dd($data, Carbon::now()->tz('America/Santo_Domingo')->format('Y-m-d H:i:s'));
        $ticket = $this->marketService->postNuevoTicket($data);
        $tickets = $ticket->ticket;

        if ($request->tic_agrupado == 1) {

            $agrupado = Tickets::ticketAgrupado($tickets);
            $receipt[] = $this->receiptContentAgrupado($empresas_id, $bancas_id, $ticket, $agrupado, null, false, true);
            $mensaje = 'Venta añadida con éxito';
            $output = ['success' => 1, 'mensaje' => $mensaje, 'receipt' => $receipt];
        } else {
            $receipt[] = $this->receiptContent($empresas_id, $bancas_id, $tickets, null, false, true);
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
        // $tickets_id,
        $tickets,
        $printer_type = null,
        $from_pos_screen = true,
        $invoice_layout_id = null,
        $ticket_copia = null
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

        // $tickets = $this->marketService->getTicket($tickets_id);
        // $ticketDetalle = $this->marketService->getTicketDetalle($tickets_id);

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

        foreach ($tickets as $ticketIndi) {
            $ticket = $this->marketService->getTicket($ticketIndi);

            $ticketDetalle = $this->marketService->getTicketDetalle($ticketIndi);

            $isAnular = Util::calcularMinutos($ticket[0]->tic_fecha_sorteo, $banca->ban_tiempo_anular);

            $detalle_ticket[] = $this->transactionUtil->getReceiptDetails($ticketIndi, $ticket, $invoice_layout, $empresas_detalle, $moneda, $banca, $receipt_printer_type, $ticketDetalle, $isAnular, $ticket_copia);
        }

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
    private function receiptContentAgrupado(
        $empresas_id,
        $bancas_id,
        $tickets_id,
        $agrupado,
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

        //Compruebe si la impresión de factura está habilitada o no.
        // Si está habilitado, obtenga el tipo de impresión.
        $output['is_enabled'] = true;

        $invoice_layout_id = !empty($invoice_layout_id) ? $invoice_layout_id : $banca->app_config_tickets_id;
        $invoice_layout = $this->bancaUtil->invoiceLayout($empresas_id, $banca->app_config_tickets_id);

        //Compruebe si se proporciona la configuración de la impresora.
        $receipt_printer_type = is_null($printer_type) ? $banca->ban_tipo_impresora : $printer_type;

        //calcular el tiempo de anular
        $isAnular = Util::calcularMinutos($agrupado['ajustes']['tic_fecha_sorteo'], $banca->ban_tiempo_anular);

        $detalle_ticket = $this->transactionUtil->getReceiptDetailsAgrupado($agrupado['tickets'], $invoice_layout, $empresas_detalle, $moneda, $banca, $receipt_printer_type, $agrupado['detalleTicket'], $agrupado['ajustes'], $agrupado['total'], $isAnular);

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
            $output['print'] = "ticketAgrupado";
        } else {

            $layout = 'sale_pos.receipts.formatoAgrupado58';
            $output['html_content'] = view($layout, compact('detalle_ticket', 'isAnular'))->render();
        }

        return $output;
    }

    public function getHorarioLoteriasDia(Request $request)
    {
       
        if ($request->ajax()) {
            
            $users_id = session()->get('user.id');

            $horaRD = HorarioLoterias::horaRD();

            $data['empresas_id'] = session()->get('user.emp_id');
            $data['bancas_id'] = session()->get('user.banca');
            $data['users_id'] = session()->get('user.id');
            $data['horario'] = session()->get('user.userHoraro');
            $data['dia'] = HorarioLoterias::dia();

            $horarioLoteria = HorarioLoterias::getHorarioLoteriasDia($data);
              
            $detalles = $this->marketService->getProgressBar($users_id);
          
            $output = '';
            $limiteVenta = Util::compararValores($detalles->limite, $detalles->total);
            // dd($limiteVenta);
            if ($limiteVenta == 0){
                foreach ($horarioLoteria as $key => $detalle) {
                    // dd($detalle->hlo_hora_fin, $horaRD);
                    $horariocierre = HorarioLoterias::compararHoras($detalle->hlo_hora_fin, $horaRD);
                   
                    if ($horariocierre == 0){
                        $output .=  '<div class="col-6 col-sm-6 col-md-6 col-lg-4 col-xl-4">
                                    <div class="icheck-material-success">
                                        <input type="checkbox" id="' . $detalle->lot_nombre . '" name="lot_id[]" value="' . $detalle->loterias_id . '|' . 0 . '|' . $detalle->hlo_hora_fin .' "/>
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
            }else{
                foreach ($horarioLoteria as $key => $detalle) {

                        $output .=  '<div class="col-6 col-sm-6 col-md-6 col-lg-4 col-xl-4">
                                    <div class="icheck-material-danger">
                                        <input type="checkbox" id="' . $detalle->lot_nombre . '" disabled/>
                                        <label  for="' . $detalle->lot_nombre . '"><span class="badge badge-danger m-1"><h6 class="text-white">' . $detalle->lot_nombre . '</h6></span></label>
                                    </div>
                                </div>';
                    
                }
                return $output;
            }


        }
    }

    public function getLoteriasSuperPale(Request $request)
    {
        if ($request->ajax()) {

            $empresas_id = session()->get('user.emp_id');
            $dia = HorarioLoterias::dia();
            $users_id = session()->get('user.id');

            $horaRD = HorarioLoterias::horaRD();
            $horarioLoteria = HorarioLoterias::getLoteriasSuperPaleDia($empresas_id, $dia);

            $detalles = $this->marketService->getProgressBar($users_id);

            $output = '';
            $limiteVenta = Util::compararValores($detalles->limite, $detalles->total);

            if ($limiteVenta == 0){
                foreach ($horarioLoteria as $key => $detalle) {
                    // dd($detalle->hlo_hora_fin, $horaRD);
                    $horariocierre = HorarioLoterias::compararHoras($detalle->hlo_hora_fin, $horaRD);

                    if ($horariocierre == 0) {
                        $output .=  '<div class="col-6 col-sm-6 col-md-6 col-lg-4 col-xl-4">
                                    <div class="icheck-material-info">
                                        <input type="checkbox" id="' . $detalle->lot_nombre . '" name="lot_id[]" value="' . $detalle->loterias_id . '|' . $detalle->lot_superpale . '|' . $detalle->hlo_hora_fin .' "/>
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
            }else{
                foreach ($horarioLoteria as $key => $detalle) {

                        $output .=  '<div class="col-6 col-sm-6 col-md-6 col-lg-4 col-xl-4">
                                    <div class="icheck-material-danger">
                                        <input type="checkbox" id="' . $detalle->lot_nombre . '" disabled/>
                                        <label  for="' . $detalle->lot_nombre . '"><span class="badge badge-danger m-1"><h6 class="text-white">' . $detalle->lot_nombre . '</h6></span></label>
                                    </div>
                                </div>';
                    
                }
                return $output;
            }
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
        $ticket[] = $tickets_id;
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
                if (request()->input('ticket_copia') == true) {
                    $ticket_copia = true;
                }
                $invoice_layout_id = !empty($invoice_layout_id) ? $invoice_layout_id : $banca->app_config_tickets_id;
                $invoice_layout = $this->bancaUtil->invoiceLayout($empresas_id, $bancas_id, $banca->app_config_tickets_id);

                $receipt = $this->receiptContent($empresas_id, $bancas_id, $ticket, $printer_type, false, $invoice_layout, $ticket_copia);


                if (!empty($receipt)) {
                    $output = ['success' => 1, 'receipt' => $receipt];
                }
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
}
