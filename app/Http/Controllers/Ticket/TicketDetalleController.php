<?php

namespace App\Http\Controllers\Ticket;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\MarketService;
use App\Utils\TicketDetalle;
use App\Utils\Util;

class TicketDetalleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(MarketService $marketService)
    {
        $this->middleware('auth');

        parent::__construct($marketService);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @var string $ticket
     */
    public function index(Request $request)
    {
        // $output = [];
        //     $apuesta = $this->marketService->getTicketDetalleBanca($request->ticket);
        //     dd(json_decode($apuesta[0]));
            $row_count = request()->get('product_row');


        //     $output['success'] = true;

        //     $output['html_content'] =  view('sale_pos.apuesta_row')
        //     ->with(compact('apuesta', 'row_count'))
        //     ->render();

        //   return  dd($output);
        // try {
        // } catch (\Exception $e) {
        //     \Log::emergency("File:" . $e->getFile() . "Line:" . $e->getLine() . "Message:" . $e->getMessage());

        //     $output['success'] = false;
        //     $output['msg'] = "esto es una prueba";
        // }
        // // $users_id = request()->session()->get('user.id');
        // // $ticket = $this->marketService->getTicketBanca($users_id);
        $ticketsDetalles = '';
        $ticketsDetalles = $this->marketService->getTicketDetalleBanca($request->ticket);

        $ticketDetalles= '';
        $datos[] = '';
        foreach ($ticketsDetalles as  $detalle) {
            $row_count = $row_count + 1;
            $ticketDetalles.= '<tr class="product_row" data-row_index='. $row_count .'>'.
            '<td>'. $detalle->modalidad->mod_nombre.'</td>'.
                '<td>
                <input type="hidden" class="form-control pos_line_total " value="' .  $detalle->tid_valor . '">
                <span class="display_currency" data-orig-value=' .  $detalle->tid_valor . ' data-currency_symbol="true">'.  $detalle->tid_valor . '</span>

                </td>'.
            '<td>' . $detalle->tid_apuesta . '</td>' .
            '<td>
            <span class="btn btn-sm btn-outline-danger waves-effect waves-light borrar" data-record-id="'. $detalle->id.'"><i class="fa fa-trash"></i></span>

            </td>' .
            '</tr>';
            }
        $datos = ['ticketDetalles' => $ticketDetalles, 'row_count' => $row_count];
        return  $datos;


        // return $output;
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)
    // {
    //     $empresas_id = session()->get('user.emp_id');

    //     //VALIDA SI EL NUMERO ESTA EN EL LISTADO DE NUMEROS CALIENTES DE LA EMPRESA
    //     // $numeroCaliente = NumerosCalientes::cnumeroCaliente($request->apd_numero);
    //     $numeroCaliente =  $this->marketService->getNumeroCalienteEmpresa($request->tid_apuesta, $empresas_id);


    //     //VALIDA SI EL NUMERO TIENE 1 DIGITO LE AÑADE EL 0
    //     $NumeroValidado = Util::numeroValido($request->tid_apuesta);

    //     /**
    //      * confirmo la modalidad de la jugada
    //      */
    //     $modalidad = Util::modalidad($NumeroValidado);

    //     /**
    //      * consulto la comision por modalidad
    //      */
    //     $comision = TicketDetalle::MontoComisionModalidad($modalidad);

    //     if ($comision == 0) {
    //         return response()->json(
    //             array(
    //                 'mensaje' => 'No tiene una comisiòn asignada para esta modalidad',
    //                 'status' => 'Comision',
    //             )
    //         );
    //     }
    //     //SI EL NUMERO ES TRIPLETA O PALE ORDENA DE MAYO A MENOR LOS NUMEROS
    //     $numeroOrdenado = Util::ordenarNumeros($NumeroValidado, $modalidad);

    //     //TRAE EL MONTO MAXIMO PERMITIDO DE APUESTA POR MODALIDAD
    //     $montoModalidad = TicketDetalle::MontoApuestaModalidad($modalidad);

    //     if ($montoModalidad == 0) {
    //         return response()->json(
    //             array(
    //                 'mensaje' => 'No tiene un Monto de apuesta minimo asignada para esta modalidad',
    //                 'status' => 'MontoIndividual',
    //             )
    //         );
    //     }
    //     // COMPARA EL MONTO PERMITIDO Y EL MONTO DE LA APUESTA
    //     $compararValores = Util::compararValores($montoModalidad, $request->tid_valor);

    //     // dd($compararValores, $montoModalidad, $request->tid_valor);
    //     dd($request->tickets_id, $numeroOrdenado);
    //      $apuesta = Util::numeroJugado($request->tickets_id, $numeroOrdenado);
    //     // dd($apuesta);
    //      if ($numeroCaliente == 1) {
    //             return response()->json(
    //                 array(
    //                     'mensaje' => 'Este Numero No Puede ser Jugado en Este Momento',
    //                     'status' => 'NumeroCaliente',
    //                 )
    //             );
    //         }
    //     if (($compararValores == 1)) {
    //             return response()->json(
    //                 array(
    //                     'mensaje' => 'El Monto Apostado Supera El Limite Permitido',
    //                     'status' => 'LimiteSuperado',
    //                 )
    //             );
    //         }
    //     // else {

    //         if (empty($apuesta)) {
    //             TicketDetalle::GenerarApuesta($request, $numeroOrdenado, $modalidad, $comision);
    //         } else {
    //            TicketDetalle::ModificarApuesta($request->tickets_id, $request->tid_valor, $apuesta->tid_valor,  $numeroOrdenado, $comision);

    //         }
    //         return
    //     response()->json(
    //         array(
    //             'mensaje' => '',
    //             'status' => 'success',
    //         )
    //     );
    //     // }

    // }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $data =  $this->marketService->deleteTicketDetalle($id);

        if ($data == true) {
            $output = [
                'status' => 'success',
                'msg' => 'Las Jugadas se Elimininaron con Exito'
            ];
        } else {
            $output = [
                'status' => 'error',
                'msg' => 'No se Pudo Eiminar Las jugadas'
            ];
        }
        return $output;
    }



}
