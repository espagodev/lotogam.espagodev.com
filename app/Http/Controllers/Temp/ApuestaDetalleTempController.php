<?php

namespace App\Http\Controllers\Temp;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\MarketService;
use App\Utils\TicketDetalle;
use App\Utils\Util;

class ApuestaDetalleTempController extends Controller
{
    public function __construct(MarketService $marketService)
    {
        $this->middleware('auth');

        parent::__construct($marketService);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $row_count = request()->get('product_row');

        $ticketsDetalles = '';
        $ticketsDetalles = $this->marketService->getApuestaDetalleTemp($request->banca, $request->usuario);

        $ticketDetalles = '';
        $datos[] = '';
        foreach ($ticketsDetalles as  $detalle) {
            $row_count = $row_count + 1;
            $ticketDetalles .= '<tr class="product_row" data-row_index=' . $row_count . '>' .
                '<td>' . $detalle->mod_nombre . '</td>' .
                '<td>
                <input type="hidden" class="form-control pos_line_total " value="' .  $detalle->apt_valor . '">
                <span class="display_currency" data-orig-value=' .  $detalle->apt_valor . ' data-currency_symbol="true">' .  $detalle->apt_valor . '</span>
                </td>' .
                '<td>' . $detalle->apt_apuesta . '</td>' .
                '<td>
                    <span class="btn btn-sm btn-outline-danger waves-effect waves-light borrar" data-record-id="' . $detalle->id . '"><i class="fa fa-trash"></i></span>
                </td>' .
            '</tr>';
        }
        $datos = ['ticketDetalles' => $ticketDetalles, 'row_count' => $row_count];
        return  $datos;
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $empresas_id = session()->get('user.emp_id');
        $users_id = request()->session()->get('user.id');
        $bancas_id = request()->session()->get('user.banca');
        //VALIDA SI EL NUMERO ESTA EN EL LISTADO DE NUMEROS CALIENTES DE LA EMPRESA
        // $numeroCaliente = NumerosCalientes::cnumeroCaliente($request->apd_numero);
        $numeroCaliente =  $this->marketService->getNumeroCalienteEmpresa($request->tid_apuesta, $empresas_id);

        //VALIDA SI EL NUMERO TIENE 1 DIGITO LE AÑADE EL 0
        $NumeroValidado = Util::numeroValido($request->tid_apuesta);

        /**
         * confirmo la modalidad de la jugada
         */
        $modalidad = Util::modalidad($NumeroValidado);

        /**
         * consulto la comision por modalidad
         */
        $comision = TicketDetalle::MontoComisionModalidad($modalidad);

        if ($comision == 0) {
            return response()->json(
                array(
                    'mensaje' => 'No tiene una comisiòn asignada para esta modalidad',
                    'status' => 'Comision',
                )
            );
        }
        //SI EL NUMERO ES TRIPLETA O PALE ORDENA DE MAYO A MENOR LOS NUMEROS
        $numeroOrdenado = Util::ordenarNumeros($NumeroValidado, $modalidad);

        //TRAE EL MONTO MAXIMO PERMITIDO DE APUESTA POR MODALIDAD
        $montoModalidad = TicketDetalle::MontoApuestaModalidad($modalidad);

        if ($montoModalidad == 0) {
            return response()->json(
                array(
                    'mensaje' => 'No tiene un Monto de apuesta minimo asignada para esta modalidad',
                    'status' => 'MontoIndividual',
                )
            );
        }
        // COMPARA EL MONTO PERMITIDO Y EL MONTO DE LA APUESTA
        $compararValores = Util::compararValores($montoModalidad, $request->tid_valor);

        // dd($compararValores, $montoModalidad, $request->tid_valor);
        // dd($request->bancas_id, $request->users_id, $numeroOrdenado);
        $apuesta = Util::numeroJugado($bancas_id, $users_id, $numeroOrdenado);
        // dd($apuesta);
        if ($numeroCaliente == 1) {
            return response()->json(
                array(
                    'mensaje' => 'Este Numero No Puede ser Jugado en Este Momento',
                    'status' => 'NumeroCaliente',
                )
            );
        }
        if (($compararValores == 1)) {
            return response()->json(
                array(
                    'mensaje' => 'El Monto Apostado Supera El Limite Permitido',
                    'status' => 'LimiteSuperado',
                )
            );
        }
        // else {

        if (empty($apuesta)) {
            TicketDetalle::GenerarApuesta($request, $numeroOrdenado, $modalidad, $comision);
        } else {

           TicketDetalle::ModificarApuesta($apuesta->id, $request->tid_valor, $apuesta->apt_valor,  $comision);

        }
        return
            response()->json(
                array(
                    'mensaje' => '',
                    'status' => 'success',
                )
            );
        // }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function eliminarJugadas($banca, $usuario)
    {

        $data =  $this->marketService->deleteApuestaTempDetalle($banca, $usuario);

        if ($data->delete != '0') {
            $output = [
                'status' => 'success',
                'msg' => 'Las Jugadas se Elimininaron con Exito'
            ];
        }
        return $output;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function eliminarApuesta($id)
    {

        $data =  $this->marketService->deleteApuestaDetalleBanca($id);

        if ($data->delete == '1') {
            $output = [
                'status' => 'success',
                'msg' => 'La Jugada se Elimino con Exito'
            ];
        } else {
            $output = [
                'status' => 'error',
                'msg' => 'No se Pudo Eiminar La jugada'
            ];
        }
        return $output;
    }


    public function duplicarTicket(Request $request, $tickets_id){


        $users_id = request()->session()->get('user.id');
        $bancas_id = request()->session()->get('user.banca');

        $this->marketService->deleteApuestaTempDetalle($bancas_id, $users_id);

        $this->marketService->getDuplicarTicket($bancas_id, $users_id, $tickets_id);


        return redirect()->action('PosController@create');
    }
}
