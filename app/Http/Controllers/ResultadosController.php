<?php

namespace App\Http\Controllers;
use App\Services\MarketService;
use App\Utils\HorarioLoterias;
use App\Utils\Reportes;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Utils\BancaUtil;

class ResultadosController extends Controller
{
    protected $bancaUtil;

    public function __construct(
        MarketService $marketService,
        BancaUtil $bancaUtil
        )
    {
        $this->middleware('auth');
        $this->bancaUtil = $bancaUtil;
        parent::__construct($marketService);
    }

    public function index()
    {

        $empresas_id = session()->get('user.emp_id');
        $loterias  = $this->marketService->getloteriasEmpresaHorario($empresas_id);
        $resultados  = $this->marketService->getResultadosEmpresa($empresas_id);

        return view('resultados.index')->with(['resultados' => $resultados, 'loterias' => $loterias]);
    }

    public function guardarResultados(Request $request)
    {

        // $data = $request->all();
        $data['empresas_id'] =  request()->session()->get('user.emp_id');
        $data['loterias_id'] =  $request->loterias_id;
        $data['res_fecha'] = $request->fecha;
        $data['res_premio1'] = $request->premio1;
        $data['res_premio2'] = $request->premio2;
        $data['res_premio3'] = $request->premio3;

        
        $data = $this->marketService->nuevoResultado($data);

        if (!empty($data)) {

            return response()->json(
                array(
                    'mensaje' => $data,
                    'status' => 'ok',
                )
            );

        }
    }

    public function validaHoraCierre(Request $request)
    {

        $fecha = Carbon::createFromFormat('d/m/Y', $request->fecha)->format('Y-m-d');
        $fechaActual = date('Y-m-d');

        $horaCierre = $request->horaCierre;

        $data['empresas_id'] = session()->get('user.emp_id');
        $data['res_fecha'] =  $fecha;
        $data['loterias_id'] =  $request->loterias_id;

        $consultaResultados =  $this->marketService->getConsultaResultados($data);

        $horaRD = HorarioLoterias::horaRD();

        $dia = HorarioLoterias::dia();

        // dd($fecha, $loterias_id, $empresa_id, $horaRD, $dia, $fechaActual);

        $compararFechas = HorarioLoterias::compararFechas($fecha, $fechaActual);

        if (!empty($consultaResultados)) {

            return response()->json($consultaResultados);

        }
        // dd($compararFechas, $horaRD, $horaCierre);
        if (($compararFechas == '1') && ($horaRD <=  $horaCierre)) {

                return response()->json(
                    array(
                        'mensaje' => 'Esta Loteria aun no Cierra',
                        'status' => 'cierre',
                    )
                );

        }else{
            return response()->json(
                array(
                    'mensaje' => '',
                    'status' => 'ok',
                )
            );
        }


    }

     public function imprimir(Request $request)
    {
        $empresa_id  = $this->marketService->getUserInformation()->emp_id;

        $receipt = '';
        $receipt = $this->receiptContent($empresa_id);

         $output = ['receipt' => $receipt];

         return redirect()
            ->route('resultados')->with('status', $output);

    }

    private function receiptContent($empresa_id)
    {

        // $output['printer_config']  = $this->marketService->getImpresorasEmpresa($empresa_id);
         $output['printer_config']  = $this->bancaUtil->printerConfig($empresa_id, $printer_id = null );


            // $invoice_layout = $this->businessUtil->invoiceLayout($business_id, $location_id, $location_details->invoice_layout_id);
            // // dd($invoice_layout);
            // //Check if printer setting is provided.
            // $receipt_printer_type = is_null($printer_type) ? $location_details->receipt_printer_type : $printer_type;

            // $receipt_details = $this->transactionUtil->getReceiptDetails($transaction_id, $location_id, $invoice_layout, $business_details, $location_details, $receipt_printer_type);
            // // dd($receipt_details);
            // $currency_details = [
            //     'symbol' => $business_details->currency_symbol,
            //     'thousand_separator' => $business_details->thousand_separator,
            //     'decimal_separator' => $business_details->decimal_separator,
            // ];

            // $receipt_details->currency = $currency_details;

            // if ($is_package_slip) {
            //     $output['html_content'] = view('sale_pos.receipts.packing_slip', compact('receipt_details'))->render();
            //     return $output;
            // }
            // //If print type browser - return the content, printer - return printer config data, and invoice format config
            // if ($receipt_printer_type == 'printer') {
            //     $output[''] = 'printer';
            //     $output['printer_config'] = $this->businessUtil->printerConfig($business_id, $location_details->printer_id);
            //     $output['data'] = $receipt_details;
            // } else {
            //     $layout = !empty($receipt_details->design) ? 'sale_pos.receipts.' . $receipt_details->design : 'sale_pos.receipts.classic';

            //     $output['html_content'] = view($layout, compact('receipt_details'))->render();
            // }

            return $output;
    }

    public function getResultadosFecha(Request $request)
    {
        if ($request->ajax()) {


            $data['empresas_id'] = session()->get('user.emp_id');
            $data['start_date'] =  $request->get('start_date');
            $data['end_date'] =   $request->get('end_date');
            $data['loterias_id'] =   $request->get('loterias_id');

            $resultadoFechas = Reportes::getResultadosFecha($data);

            $output = '';
            foreach ($resultadoFechas as  $detalle) {

                $output .= '<tr>' .
                    '<td>' . $detalle->lot_nombre . '</td>' .
                    "<td>
                            <span class='badge badge-pill badge-primary m-1'> $detalle->res_premio1</span>
                            <span class='badge badge-pill badge-secondary m-1'> $detalle->res_premio2</span>
                            <span class='badge badge-pill badge-success m-1'> $detalle->res_premio3</span></td>" .

                    '</tr>';
            }

            return $output;
        }

    }

    public function getResultadosFechaPrint(Request $request)
    {
        if ($request->ajax()) {

            $data['empresas_id'] = session()->get('user.emp_id');
            $data['start_date'] =  $request->get('start_date');
            $data['end_date'] =   $request->get('end_date');
            $data['loterias_id'] =   $request->get('loterias_id');


            $data = Reportes::getResultadosFechaPrint($data);


            $output = ['success' => 1, 'receipt' => $data];

            return $output;
        }
    }

    public function getResultadosDelete($id)
    {
        if (request()->ajax()) {
            $empresas_id = session()->get('user.emp_id');

            $data = $this->marketService->deleteResultadosLoteria($empresas_id, $id);

            return response()->json($data);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getNuevoResultado()
    {
        $empresas_id = session()->get('user.emp_id');
        $loterias  = $this->marketService->getloteriasEmpresaHorario($empresas_id);

        return view('resultados.resultados_create')->with(['loterias' => $loterias]);
    }
}
