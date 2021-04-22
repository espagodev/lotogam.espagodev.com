<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MarketService;

class NumerosCalientesController extends Controller
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
        $numerosCalientes = $this->marketService->getNumerosCalientes();
        // return view('ajustes/empresas.index')->with(compact('empresa', 'documentos'));
         return view('ajustes/numerosC.index')->with(compact('numerosCalientes'));
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
        $data['empresas_id'] =  request()->session()->get('user.emp_id');
        $data = $this->marketService->nuevoNumeroCaliente($data);



        return redirect()
            ->route(
            'NumerosCalientes')
            ->with('success', ['Comision Creada Satisfactoriamente']);
    }
}
