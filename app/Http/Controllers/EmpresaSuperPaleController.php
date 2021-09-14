<?php

namespace App\Http\Controllers;

use App\Services\MarketService;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class EmpresaSuperPaleController extends Controller
{
    public function __construct(MarketService $marketService)
    {
        $this->middleware('auth');

        parent::__construct($marketService);
    }

     public function index()
    {
        $empresas_id  =   session()->get('user.emp_id');
        $loterias = $this->marketService->getLoterias();

        if (request()->ajax()) {
            
            $superPales  = $this->marketService->getLoteriasSuperpale($empresas_id);           
            
            return Datatables::of($superPales)
            ->addColumn(
                     'estado',
                    '<button type="button" data-href="{{action(\'EmpresaLoteriasController@activarDesactivarLoteria\', [$id])}}" class="btn btn-sm activar-inactivar-loteria @if($loe_estado) btn-danger @else btn-success @endif"><i class="fa fa-power-off"></i> @if($loe_estado) Inactivar Loteria @else Activar Loteria @endif </button>'
                )
                 ->addColumn(
                     'action',
                     '<button data-href="{{action(\'EmpresaSuperPaleController@getModificarLoteriaSuperPale\', [$id]) }}"  class="btn btn-outline-warning modificar-superpale" rel="tooltip" title="Editar Loteria Super" ><i class="fa fa-pencil"></i></button>
                    '
                )
                ->rawColumns(['action', 'estado'])
                ->make(true);
        }

        return view('ajustes/superpales.index')->with(compact('loterias'));
    }
       
  

     public function store(Request $request)
    {

        $data = $request->all();
        $data['empresas_id'] =   session()->get('user.emp_id');
        $data['lot_superpale'] = '1';

        $data = $this->marketService->nuevaLoteriaSuperpale($data);


        return redirect()
            ->route(
            'superPaleEmpresa')
            ->with('success', ['Loteria Creada Satisfactoriamente']);
    }

        public function getSuperPaleEmpresaDelete($id)    {
        
            $empresas_id = session()->get('user.emp_id');

            $data = $this->marketService->getSuperPaleEmpresaDelete($empresas_id, $id);

        return json_encode($data);
        
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
        $data['empresas_id'] =   session()->get('user.emp_id');
        
        $this->marketService->ModificarSuperPale($id, $data);

        return redirect()
            ->route(
            'superPaleEmpresa.index'
            )
            ->with('success', ['El SuperPale se ha modificado Satisfactoriamente']);
    }


    public function getNuevoSuperPale()
    {

        $loterias = $this->marketService->getLoterias();

        return view('ajustes.superpales.superpale_nueva')->with(['loterias' =>$loterias]);
    }

        /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getModificarLoteriaSuperPale($id)
    {
        $loterias = $this->marketService->getLoterias();
        $loteria = $this->marketService->getLoteriaSuperpale($id);
       
        return view('ajustes.superpales.superpale_modificar')->with(['loteria' => $loteria, 'loterias' =>$loterias]);
    }
}
