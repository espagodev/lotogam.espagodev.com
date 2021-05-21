<?php

namespace App\Http\Controllers\Temp;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\MarketService;
use App\Utils\Montos;
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


        $parametrosBanca = $this->marketService->getParametrosBanca($bancas_id);


        /**
         * VALIDA SI EL NUMERO TIENE 1 DIGITO LE AÑADE EL 0
         */
        $NumeroValidado = Util::numeroValido($request->tid_apuesta);

        /**
         * confirmo la modalidad de la jugada
         */
        $modalidad = Util::modalidad($NumeroValidado);

        /**
         * SI EL NUMERO ES TRIPLETA O PALE ORDENA DE MAYO A MENOR LOS NUMEROS
         */
        $numeroOrdenado = Util::ordenarNumeros($NumeroValidado, $modalidad);

        /**
         * VALIDA SI EL NUMERO ESTA EN EL LISTADO DE NUMEROS CALIENTES DE LA EMPRESA
         */
        $numeroCaliente =  $this->marketService->getNumeroCalienteEmpresa($request->tid_apuesta, $empresas_id);
        if ($numeroCaliente == 1) {
            return response()->json(
                array(
                    'mensaje' => 'Este Numero No Puede ser Jugado en Este Momento',
                    'status' => 'NumeroCaliente',
                )
            );
        }

        /**
         * consulto la comision por modalidad
         */

        $comision = Montos::Comision($parametrosBanca->comisiones_id, $modalidad);

        if ($comision == 0) {
            return response()->json(
                array(
                    'mensaje' => 'No tiene una comisiòn asignada para esta modalidad',
                    'status' => 'Comision',
                )
            );
        }

         $validacionMontos = Montos::validarMonto($parametrosBanca, $modalidad, $numeroOrdenado, $users_id, $bancas_id, $comision, $request);



        if (!empty($validacionMontos)) {
            return $validacionMontos;
        }else{
           return response()->json(
                array(
                    'mensaje' => '',
                    'status' => 'success',
                )
            );
        }

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


    public function duplicarTicket(Request $request, $tickets_id)
    {


        $users_id = request()->session()->get('user.id');
        $bancas_id = request()->session()->get('user.banca');

        $this->marketService->deleteApuestaTempDetalle($bancas_id, $users_id);

        $this->marketService->getDuplicarTicket($bancas_id, $users_id, $tickets_id);


        return redirect()->action('PosController@create');
    }


    public function getvalidarMontos(Request $request)
    {
        if ($request->ajax()) {

            $arrayVendidos = array();
            $arrayIndividual = array();
            $arrayGlobal = array();
            $compararMontos = "";

            $ticketsDetalles = $this->marketService->getApuestaDetalleTemp($request->bancas_id, $request->users_id);
            $parametrosBanca = $this->marketService->getParametrosBanca($request->bancas_id);

            foreach ($ticketsDetalles as $detalle) {

                if ($request->lot_superpale == 1) {
                    $modalidades_id = 4;
                } else {
                    $modalidades_id = $detalle->modalidades_id;
                }

                $montoGlobal= Montos::MontoGlobal($parametrosBanca->montos_globales_id, $modalidades_id);

                $montoIndividual = Montos::MontoIndividual($parametrosBanca->montos_individuales_id, $modalidades_id);

                $controlNumeroGlobal = Util::ControlNumeroJugado($request->loterias_id, $bancas_id = null, $users_id = null, $detalle->apt_apuesta);

                $controlNumero = Util::ControlNumeroJugado($request->loterias_id, $request->bancas_id, $request->users_id, $detalle->apt_apuesta);

                $totalApuesta = Util::totalApuesta($detalle->apt_valor, $controlNumero);


                $comparacion = Util::compararValores($montoIndividual, $controlNumero);
                // dump($comparacion, $montoIndividual, $controlNumero);

                if ($comparacion == 1) {
                    $arrayVendidos[] = $detalle->apt_apuesta;
                }

                if ($totalApuesta > $montoIndividual) {
                    $arrayIndividual[] = $detalle->apt_apuesta . ' Supera Limite de Apuesta Permitido  de ' . $montoIndividual;
                }
                //  dd($controlNumeroGlobal , $montoGlobal);
                if ($controlNumeroGlobal >= $montoGlobal) {
                    $arrayGlobal[] = $detalle->apt_apuesta . ' El Numero no esta Disponible por el Momento';
                }

                if ($montoIndividual > $montoGlobal) {
                    $compararMontos =  ' El Limite Individual no Puede ser Mayor que el Global, Contacte con el Administrador ';
                }
            }

            $vendidos = trim(implode(" , ", $arrayVendidos));
            $vendidos = "'" . $vendidos . "'";

            $supera = trim(implode(" , ", $arrayIndividual));
            $supera = "$supera ";

            $global = trim(implode(" , ", $arrayGlobal));
            $global = "$global ";


            if (count($arrayVendidos) != "0") {
                return response()->json([
                    'numero' => $vendidos,
                    'loteria' => $request->lot_nombre,
                    'status' => 1,
                ]);
            }

            if (count($arrayIndividual) != "0") {
                return response()->json([
                    'numero' => $supera,
                    'loteria' => $request->lot_nombre,
                    'status' => 2,
                ]);
            }

            if (count($arrayGlobal) != "0") {
                return response()->json([
                    'numero' => $global,
                    'loteria' => $request->lot_nombre,
                    'status' => 3,
                ]);
            }

            if ($compararMontos != "") {
                return response()->json([
                    'numero' => $compararMontos,
                    'status' => 4,
                ]);
            }
        }
    }
}
