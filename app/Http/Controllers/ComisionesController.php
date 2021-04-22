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

        // $rules = [
        //     'lot_codigo' => 'required',
        //     'lot_nombre' => 'required',
        //     'lot_abreviado' => 'required'
        // ];

        // $data = $this->validate($request, $rules);

        $data = $request->all();
        $data['empresas_id'] =  session()->get('user.emp_id');

        $data = $this->marketService->nuevaComision($data);



        return redirect()
            ->route(
            'comisiones')
            ->with('success', ['Comision Creada Satisfactoriamente']);
    }
}
