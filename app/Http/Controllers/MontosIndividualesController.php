<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MarketService;

class MontosIndividualesController extends Controller
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
        $montosIndividuales  = $this->marketService->getMontosIndividualesEmpresa($empresas_id);
         return view('ajustes/montosI.index')->with(compact('montosIndividuales'));
    }

     public function store(Request $request)
    {

        $data = $request->all();
        $data['empresas_id'] = $this->marketService->getUserInformation()->idEmpresa;
        $data = $this->marketService->nuevoMontoIndividual($data);

        return redirect()
            ->route(
            'montosIndividuales.index')
            ->with('success', ['El Monto Individual se creo Satisfactoriamente']);
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

        $this->marketService->ModificarMontoIndividual($id, $data);

        return redirect()
            ->route(
            'montosIndividuales.index'
            )
            ->with('success', ['El Monto se ha modificado Satisfactoriamente']);
    }

    public function getNuevoMontoIndividual()
    {
        return view('ajustes.montosI.modal_create');
    }

    public function getModificarMontoIndividual($id)
    {
        $montoIndividual = $this->marketService->getMontoIndividualDetalle($id);

        return view('ajustes.montosI.modal_edit')->with(['montoIndividual' => $montoIndividual]);
    }
}
