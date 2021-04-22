<?php

namespace App\Http\Controllers;

use App\Services\MarketService;
use Illuminate\Http\Request;

class EmpresaSuperPaleController extends Controller
{
    public function __construct(MarketService $marketService)
    {
        $this->middleware('auth');

        parent::__construct($marketService);
    }

     public function index()
    {
        $empresa  =  $this->marketService->getUserInformation()->idEmpresa;
        $superPales  = $this->marketService->getLoteriasSuperpale($empresa);
        $loterias = $this->marketService->getLoterias();

         return view('ajustes/superpales.index')->with(compact('loterias','superPales'));
    }

     public function store(Request $request)
    {

        $data = $request->all();
        $data['empresas_id'] = $this->marketService->getUserInformation()->idEmpresa;
        $data['lot_superpale'] = '1';

        $data = $this->marketService->nuevaLoteriaSuperpale($data);


        return redirect()
            ->route(
            'superPaleEmpresa')
            ->with('success', ['Loteria Creada Satisfactoriamente']);
    }
}
