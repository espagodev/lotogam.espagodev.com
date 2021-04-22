<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MarketService;
use App\Utils\HorarioLoterias;
use App\Utils\Util;

class EmpresaLoteriasController extends Controller
{
     public function __construct(MarketService $marketService)
    {
        $this->middleware('auth');

        parent::__construct($marketService);
    }


     public function index()
    {
        $empresa  =  $this->marketService->getUserInformation()->idEmpresa;

        // $loteriasEmpresa  = $this->marketService->getLoteriasEmpresa($empresa);
        $loteriasEmpresa  = $this->marketService->getLoteriasEmpresaFaltantes($empresa);

        // return view('ajustes/empresas.index')->with(compact('empresa', 'documentos'));
         return view('ajustes/loterias.index')->with(compact('loteriasEmpresa'));
    }


    public function show($loteria){

        $empresas_id = session()->get('user.emp_id');
        $loteria = $this->marketService->getLoteria($loteria);

        $sorteos = json_decode($loteria->sorteo, true);

        $horarios = HorarioLoterias::horario($bancas_id = null, $empresas_id, $loteria->identificador);
        // dd($horarios);
        $dias = Util::dias();

        return view('ajustes/loterias.show')->with(compact('loteria', 'dias','sorteos', 'horarios'));

    }

    public function store(Request $request)
    {

        $data = $request->all();
        $data['empresas_id'] = session()->get('user.emp_id');
        // dd($request);
        $data = $this->marketService->nuevoHorarioLoteria($data);

        return back();
    }

    public function update(Request $request,  $loteria){

        $data = $request->all();
        $data = $request->except('_token');
        $data['loterias_id'] = $loteria;
        $data['empresas_id'] = session()->get('user.emp_id');


         $data = HorarioLoterias::getActualizarHorarioLoteria($loteria, $data);

        return back()
        // return redirect()
        //     ->route(
        //     'ajustesLoterias.index'
        //     )
            ->with('success', ['El Horario se ha Modificado Satisfactoriamente']);
    }


    public function getEmpresaLoteriaEstado(Request $request){

        $data = $request->all();
        $data['empresas_id'] = session()->get('user.emp_id');
   
        $loteria = $this->marketService->getEmpresaLoteriaEstado($data);

    }
}
