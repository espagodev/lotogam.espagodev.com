<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MarketService;
use App\Utils\HorarioLoterias;
use App\Utils\Util;
use Yajra\DataTables\Facades\DataTables;

class EmpresaLoteriasController extends Controller
{
     public function __construct(MarketService $marketService)
    {
        $this->middleware('auth');

        parent::__construct($marketService);
    }


     public function index()
    {
        $empresa  =   session()->get('user.emp_id');

        if (request()->ajax()) {

            $loteriasEmpresa  = $this->marketService->getLoteriasEmpresaFaltantes($empresa);
            
            return Datatables::of($loteriasEmpresa)
            ->addColumn('horario', function ($row) {
                    if ($row->loe_estado != null) {
                        return ' <a href="' . route('ajustesLoterias.show', [$row->id]) .'" class="btn btn-outline-info btn-sm" rel="tooltip" title="Horario de la Loteria" > <i class="fa fa-clock-o"></i> </a>';
                    } 
                })
                 ->addColumn(
                     'action',
                    '<button type="button" data-href="{{action(\'EmpresaLoteriasController@activarDesactivarLoteria\', [$id])}}" class="btn btn-sm activar-inactivar-loteria @if($loe_estado) btn-danger @else btn-success @endif"><i class="fa fa-power-off"></i> @if($loe_estado) Inactivar Loteria @else Activar Loteria @endif </button>'

                )
                ->rawColumns(['action', 'horario'])
                ->make(true);
        }

        return view('ajustes/loterias.index');
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
            ->with('success', ['El Horario se ha Modificado Satisfactoriamente']);
    }


    public function activarDesactivarLoteria($loterias_id){


        $data['loterias_id'] = $loterias_id;
        $data['empresas_id'] = session()->get('user.emp_id');

        $estado = $this->marketService->getEmpresaLoteriaEstado($data);


        return json_encode($estado);

    }
}
