<?php

namespace App\Http\Controllers;

use App\Services\MarketService;
use Illuminate\Http\Request;

class ComisionesController extends Controller
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
        $comisiones  = $this->marketService->getComisionesEmpresa($empresas_id);

         return view('ajustes/comisiones.index')->with(compact('comisiones'));
    }

     public function store(Request $request)
    {

        $data = $request->all();
        $data['empresas_id'] =  session()->get('user.emp_id');

        $data = $this->marketService->nuevaComision($data);



        return redirect()
            ->route(
            'comisiones.index')
            ->with('success', ['Comision Creada Satisfactoriamente']);
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

        $this->marketService->ModificarComision($id, $data);

        return redirect()
            ->route(
                'comisiones.index'
            )
            ->with('success', ['La Comision se ha modificado Satisfactoriamente']);
    }

    public function getNuevaComision()
    {

        return view('ajustes.comisiones.modal_create');
    }

    public function getModificarComision($id)
    {
        $comision = $this->marketService->getComisionDetalle($id);

        return view('ajustes.comisiones.modal_edit')->with(['comision' => $comision]);
    }
}
