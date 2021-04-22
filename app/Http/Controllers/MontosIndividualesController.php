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
        // $montosIndividuales = $this->marketService->getMontosIndividuales();
        $montosIndividuales  = $this->marketService->getMontosIndividualesEmpresa($empresas_id);
        // return view('ajustes/empresas.index')->with(compact('empresa', 'documentos'));
         return view('ajustes/montosI.index')->with(compact('montosIndividuales'));
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
        $data = $this->marketService->nuevoMontoIndividual($data);



        return redirect()
            ->route(
            'montosIndividuales')
            ->with('success', ['El Monto Individual se creo Satisfactoriamente']);
    }
}
