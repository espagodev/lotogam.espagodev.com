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
        
        // $montosGlobales = $this->marketService->getMontosGlobales();
        // return view('ajustes/empresas.index')->with(compact('montosGlobales', 'documentos'));
         return view('ajustes/montosG.index')->with(compact('montosGlobales'));
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
        $data['empresas_id'] = $this->marketService->getUserInformation()->idEmpresa;
        $data = $this->marketService->nuevoMontoGlobal($data);



        return redirect()
            ->route(
            'montosGlobales')
            ->with('success', ['El Monto Global se creo Satisfactoriamente']);
    }
}
