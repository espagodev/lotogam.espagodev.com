<?php

namespace App\Http\Controllers;

use App\Utils\BancaUtil;
use App\Utils\CajaRegistradoraUtil;
use App\Utils\HorarioLoterias;
use App\Utils\Util;
use Illuminate\Http\Request;

class CajaRegistradoraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('caja_registradora.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $data['empresas_id'] = session()->get('user.emp_id');
        $data['users_id'] = session()->get('user.id');
        $data['bancas_id'] = session()->get('user.banca');

        $data = $this->marketService->postCajaRegistradora($data);

        $fecha = HorarioLoterias::fechaActual();
        $dia = HorarioLoterias::dia($fecha);
        $horaRD = HorarioLoterias::horaRD();

        $bancas_id = request()->session()->get('user.banca');
        $users_id = session()->get('user.id');
        $symbol = request()->session()->get('currency.symbol');
        $limite_venta = session()->get('banca.limite_venta');

        $loterias = $this->marketService->getHorarioLoteriasBanca($bancas_id, $dia);
        $parametros =  $this->marketService->getParametrosBanca($bancas_id);

        $fechaActual = now()->format('d/m/Y');
        $venta = BancaUtil::progressBar($users_id, $bancas_id);
        $ventaTotal = !empty($venta->venta) ? $venta->venta : 0;

        $venta_porcentaje = Util::get_progress($ventaTotal, $limite_venta);

        return redirect()->action('PosController@create')->with([
            'loterias' => $loterias,
            'symbol' => $symbol,
            'horaRD' => $horaRD,
            'parametros' => $parametros,
            'fechaActual' => $fechaActual,
            'venta' => $ventaTotal,
            'venta_porcentaje' => $venta_porcentaje
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('caja_registradora.detalle_registro');
    }


    /**
     * Closes currently opened register.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postCerrarRegistro(Request $request)
    {

        try {
            $user_id = session()->get('user.id');

            $data = $request->only(['closing_amount', 'caj_nota_cierre']);
            $data['caj_monto_cierre'] = $this->cashRegisterUtil->num_uf($data['caj_monto_cierre']);
            $data['caj_hora_cierre'] = \Carbon::now()->format('Y-m-d H:i:s');
            $data['caj_estado'] = 'Cerrado';


            Cajas::where('user_id', $user_id)
                ->where('caj_estado', 'Abierto')
                ->update($data);
            $output = [
                'success' => 1,
                'msg' => __('cash_register.close_success')
            ];
        } catch (\Exception $e) {
            \Log::emergency("File:" . $e->getFile() . "Line:" . $e->getLine() . "Message:" . $e->getMessage());
            $output = [
                'success' => 0,
                'msg' => __("messages.something_went_wrong")
            ];
        }
        $data = $this->marketService->postCerrarRegistro($data);
        
        return redirect()->back()->with('status', $output);
    }

    /**
     * Shows close register form.
     *
     * @param  void
     * @return \Illuminate\Http\Response
     */
    public function getCerrarRegistro($id = null)
    {
        $users_id = session()->get('user.id');
        $close_time = \Carbon::now()->toDateTimeString();

        $detalles = $this->marketService->getCajaRegistradoraDetalle($users_id, $caja_registradoras_id = null);
        return view('caja_registradora.cerrar_registro')->with(compact('close_time', 'detalles'));
    }

    /**
     * Shows register details modal.
     *
     * @param  void
     * @return \Illuminate\Http\Response
     */
    public function getDetalleRegistro()
    {

        $users_id = session()->get('user.id');
        // $register_details =  $this->cashRegisterUtil->getRegisterDetails();

        // $user_id = auth()->user()->id;
        // $open_time = $register_details['open_time'];
        $close_time = \Carbon::now()->toDateTimeString();

        $detalles = $this->marketService->getCajaRegistradoraDetalle($users_id, $caja_registradoras_id = null);

        // $detalles = CajaRegistradoraUtil::getCajaRegistradoraDetalles($users_id, $close_time);

        dump($detalles);

        return view('caja_registradora.detalle_registro')
        ->with(compact('close_time', 'detalles'))
        ;
    }

}
