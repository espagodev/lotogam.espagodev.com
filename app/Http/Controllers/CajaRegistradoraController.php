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
        $venta_porcentaje = Util::get_progress($venta->total_venta, $limite_venta);

        return redirect()->action('PosController@create')->with([
            'loterias' => $loterias,
            'symbol' => $symbol,
            'horaRD' => $horaRD,
            'parametros' => $parametros,
            'fechaActual' => $fechaActual,
            'venta' => $venta,
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

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
        //
    }

    /**
     * Shows close register form.
     *
     * @param  void
     * @return \Illuminate\Http\Response
     */
    public function getCerrarRegistro($id = null)
    {
        return view('caja_registradora.cerrar_registro');
    }

    /**
     * Shows register details modal.
     *
     * @param  void
     * @return \Illuminate\Http\Response
     */
    public function getDetalleRegistro()
    {



        // $register_details =  $this->cashRegisterUtil->getRegisterDetails();

        // $user_id = auth()->user()->id;
        // $open_time = $register_details['open_time'];
        $close_time = \Carbon::now()->toDateTimeString();

        $detalles = $this->marketService->getCajaRegistradoraDetalle($users_id);
        
        $detalles = CajaRegistradoraUtil::getCajaRegistradoraDetalles($user_id, $close_time);



        return view('caja_registradora.detalle_registro')
        ->with(compact('close_time'))
        ;
    }

}
