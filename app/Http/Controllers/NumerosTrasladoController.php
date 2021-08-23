<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MarketService;

class NumerosTrasladoController extends Controller
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
        $traslados  = $this->marketService->getNumerosTrasladoEmpresa($empresas_id);
        
         return view('ajustes/numerosTraslado.index')->with(compact('traslados'));
    }

     public function store(Request $request)
    {

        $data = $request->all();
        $data['empresas_id'] = session()->get('user.emp_id');
        $data = $this->marketService->nuevoNumerosTraslado($data);

        return redirect()
            ->route(
            'numerosTraslado.index')
            ->with('success', ['El Limite se creo Satisfactoriamente']);
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

        $this->marketService->ModificarNumerosTraslado($id, $data);

        return redirect()
            ->route(
            'numerosTraslado.index'
            )
            ->with('success', ['El Limite se ha modificado Satisfactoriamente']);
    }

    public function getNuevoTraslado (){

        return view('ajustes.numerosTraslado.modal_create');
    }

    public function getModificarTraslado($id)
    {
        $traslado = $this->marketService->getNumerosTrasladoDetalle($id);

        return view('ajustes.numerosTraslado.modal_edit')->with(['traslado' => $traslado]);
    }
}
