<?php

namespace App\Http\Controllers;

use App\Utils\BancaUtil;
use App\Utils\CajaRegistradoraUtil;
use App\Utils\HorarioLoterias;
use App\Utils\Util;
use Carbon\Carbon;
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


            $data = $request->only(['caj_monto_cierre', 'caj_nota_cierre']);
            $data['users_id'] = session()->get('user.id');

            $data = $this->marketService->postCerrarRegistro($data);

            $output = [
                'success' => 1,
                'msg' => "Caja Cerrada Satisfactoriamente"
            ];
        } catch (\Exception $e) {
            \Log::emergency("File:" . $e->getFile() . "Line:" . $e->getLine() . "Message:" . $e->getMessage());
            $output = [
                'success' => 0,
                'msg' => "Algo salió mal, por favor intente de nuevo más tarde"
            ];
        }
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
        $close_time = \Carbon::now()->toDateTimeString();

        $detalles = $this->marketService->getCajaRegistradoraDetalle($users_id, $caja_registradoras_id = null);

        return view('caja_registradora.detalle_registro')->with(compact('close_time', 'detalles'));
    }

    public function getProgressBar()
    {
        $users_id = session()->get('user.id');

        $detalles = $this->marketService->getProgressBar($users_id);

        return json_encode($detalles);
    }

}
