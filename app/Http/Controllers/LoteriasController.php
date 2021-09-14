<?php

namespace App\Http\Controllers;

use App\Services\MarketService;
use App\ConfigEmpresa\ConfigEmpresa;
use App\Utils\Util;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class LoteriasController extends Controller
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

    /**
     * return page with loteria details
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $empresa  =   session()->get('user.emp_id');

        if (request()->ajax()) {

            $loterias = $this->marketService->getLoterias();

            return DataTables::of($loterias)
            ->addColumn('logo', function ($row) {
                return '<img src="'.$row->lot_imagen.'" class="customer-img rounded">';

            })
                 ->addColumn(
                     'estado',
                    '<button type="button" data-href="{{action(\'LoteriasController@activarDesactivarLoteria\', [$id])}}" class="btn btn-sm activar-inactivar-loteria @if($lot_estado) btn-danger @else btn-success @endif"><i class="fa fa-power-off"></i> @if($lot_estado) Inactivar Loteria @else Activar Loteria @endif </button>'
                )
                ->addColumn('action', function ($row) {
                    if ($row->lot_estado == 1) { 
                        return '<button type="button" data-href="' . action('LoteriasController@getModificarLoteria', [$row->id]) . '"  class="btn btn-sm btn-outline-warning  modificar-modal btn-modal"
                        ><i class="fa fa fa-pencil"></i> </button>
                            ';
                    }
                })
                ->rawColumns(['action','logo','estado'])
                ->make(true);
        }

        return view('loterias.index');


        // $loterias = $this->marketService->getLoterias();
        // return view('loterias.index')->with(['loterias' => $loterias]); 
    }

    public function store(Request $request)
    {

        // $rules = [
        //     'lot_codigo' => 'required',
        //     'lot_nombre' => 'required',
        //     'lot_abreviado' => 'required'
        // ];

        // $horaSorteo = $request->input('sorteo');
        // $data['lot_sorteo'] = json_encode($horaSorteo);
        // $data = $this->validate($request, $rules);
        $data = $request->only('lot_nombre','lot_abreviado','lot_zona_horaria','lot_grupo','lot_comision','modalidades_id');
      

        if ($request->hasFile('lot_imagen')) {
            $data['lot_imagen'] = fopen($request->lot_imagen->path(), 'r');
          
        }
         
        $data = $this->marketService->nuevaLoteria($data);
       
        return redirect()
            ->route(
            'loterias.index')
            ->with('success', ['Loteria Creada Satisfactoriamente']);
    }

    public function update(Request $request, $id)
    {
       
        $sorteos = $request->input('sorteo');

        $data = $request->all();
        // $data = $request->except('_token');
        // $data['lot_nombre'] =  $request->input('lot_nombre');
        // $data['lot_abreviado'] =  $request->input('lot_abreviado');
        // $data['lot_codigo'] =  $request->input('lot_codigo');

        if ($request->hasFile('lot_imagen')) {
            $data['lot_imagen'] = fopen($request->lot_imagen->path(), 'r');
        }
        // $data['lot_sorteo'] = json_encode($sorteos);

        
        $this->marketService->ModificarLoteria($id, $data);

        return redirect()
            ->route(
                'loterias.index'
            )
            ->with('success', ['Loteria Modificada Satisfactoriamente']);
    }

    public function activarDesactivarLoteria($loterias_id){

        $data['loterias_id'] = $loterias_id;

        $estado = $this->marketService->getLoteriaEstado($data);

        return json_encode($estado);
    }

    public function getNuevaLoteria()
    {
        $countLoterias = $this->marketService->getTotalLoterias();
        $totalLoterias = json_decode($countLoterias);
        $zonasHoraria = ConfigEmpresa::zonaHoraria();
        $grupos = Util::loteriaGrupo();
        $modalidades = $this->marketService->getModalidades();

        return view('loterias.modal_create')->with(['zonasHoraria' => $zonasHoraria, 'totalLoterias' => $totalLoterias, 'grupos' => $grupos, 'modalidades' => $modalidades ]);
    }

    public function getModificarLoteria($id) 
    {
        $zonasHoraria = ConfigEmpresa::zonaHoraria();
        $loteria = $this->marketService->getLoteria($id);
        
        // $sorteos = json_decode($loteria[0]->lot_sorteo, true);
        $grupos = Util::loteriaGrupo();       
        $modalidades = $this->marketService->getModalidades();

        return view('loterias.modal_edit')->with(['loteria' => $loteria, /*'sorteos' => $sorteos,*/'zonasHoraria' => $zonasHoraria, 'grupos' => $grupos, 'modalidades' => $modalidades]);
    }
}
