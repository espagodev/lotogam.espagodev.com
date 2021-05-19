<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MarketService;

class MontosGlobalesController extends Controller
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

     public function index()
    {
        $empresas_id = session()->get('user.emp_id');
        $montosGlobales  = $this->marketService->getMontosGlobalesEmpresa($empresas_id);
         return view('ajustes/montosG.index')->with(compact('montosGlobales'));
    }

     public function store(Request $request)
    {


        $data = $request->all();
        $data['empresas_id'] = session()->get('user.emp_id');
        $data = $this->marketService->nuevoMontoGlobal($data);

        return redirect()
            ->route(
            'montosGlobales.index')
            ->with('success', ['El Monto Global se creo Satisfactoriamente']);
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
        $data = $request->all();
        $data = $request->except('_token');

        $this->marketService->ModificarMontoGlobal($id, $data);

        return redirect()
            ->route(
            'montosGlobales.index'
            )
            ->with('success', ['El Monto se ha modificado Satisfactoriamente']);
    }

    public function getNuevoMontoGlobal (){

        return view('ajustes.montosG.modal_create');
    }

    public function getModificarMontoGlobal($id)
    {
        $montoGlobal = $this->marketService->getMontoGlobalDetalle($id);

        return view('ajustes.montosG.modal_edit')->with(['montoGlobal' => $montoGlobal]);
    }
}
