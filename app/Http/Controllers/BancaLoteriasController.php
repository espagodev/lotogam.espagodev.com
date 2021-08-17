<?php

namespace App\Http\Controllers;

use App\Services\MarketService;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Utils\Util;
use App\Utils\HorarioLoterias;

class BancaLoteriasController extends Controller
{
    public function __construct(MarketService $marketService)
    {
        $this->middleware('auth');

        parent::__construct($marketService);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($banca_url)
    {
       
        $banca  = $this->marketService->getBancaDetalle($banca_url);     

        if (request()->ajax()) {

            $loteriasBanca  = $this->marketService->getLoteriasBancaFaltantes($banca);
          
            return Datatables::of($loteriasBanca)
           
            ->addColumn('horario', function ($row) {

                    if ($row->lob_estado != null) { 
                        return '<button type="button"  data-href="' . action('BancaLoteriasController@getModificarHorarioBanca', [$row->id, $row->bancas_id ]) . '"  class="btn btn-sm btn-outline-info btn-modal"
                        data-container=".view_register"><i class="fa fa-clock-o"></i> </button>
                            ';
                    }
                })
                ->addColumn('action', function ($row) use ($banca) {    
                    if($row->lob_estado)
                    {
                      $estado = " btn-danger";
                      $mensaje = "Inactivar Loteria";
                    }else{
                        $estado = " btn-success";
                        $mensaje = "Activar Loteria";
                    }
                        return  '<button type="button"  data-href="'. action('BancaLoteriasController@activarDesactivarBancaLoteria', [$row->id, $banca->id ]).'" class="btn btn-sm activar-inactivar-loteria'. $estado .'"><i class="fa fa-power-off"></i> '.$mensaje.'</button>';
                })

                ->rawColumns(['action', 'horario'])
                ->make(true);
        } 
        return view('ajustesBanca.loterias.index')->with(['banca' => $banca]);
    }

    public function store(Request $request)
    {

        $data = $request->all();
        $data['empresas_id'] = session()->get('user.emp_id');
        $data = $this->marketService->nuevoHorarioLoteria($data);

        return back();
    }

    public function update(Request $request,  $loteria)
    {
       
        $data = $request->all();
        $data = $request->except('_token');
        $data['loterias_id'] = $loteria;       
        $data['empresas_id'] = session()->get('user.emp_id');

         $data = HorarioLoterias::getActualizarHorarioBancaLoteria($loteria, $data);

        return back()
            ->with('success', ['El Horario se ha Modificado Satisfactoriamente']);
    }


    public function activarDesactivarBancaLoteria($loterias_id, $bancas_id)
    {
        
        $data['loterias_id'] = $loterias_id;
        $data['bancas_id'] = $bancas_id;
        $data['empresas_id'] = session()->get('user.emp_id');

        $estado = $this->marketService->getBancaLoteriaEstado($data);

        return json_encode($estado);

    }

    public function getModificarHorarioBanca($loteria, $banca)
    {

        $empresas_id = session()->get('user.emp_id');

        $loteria = $this->marketService->getLoteria($loteria);      
       
        $sorteos = json_decode($loteria->lot_sorteo, true);
        
        $horarios = HorarioLoterias::BancaHorario($banca,  $loteria->id);
        
        $dias = Util::dias();
        
        return view('ajustesBanca.loterias.modal_edit')->with(compact('loteria', 'dias','sorteos','horarios','banca'));
    }
}
