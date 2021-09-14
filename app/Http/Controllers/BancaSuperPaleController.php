<?php

namespace App\Http\Controllers;

use App\Services\MarketService;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class BancaSuperPaleController extends Controller
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

            $loteriasBanca  = $this->marketService->getLoteriasSuperPaleBancaFaltantes($banca);

            return DataTables::of($loteriasBanca)
           
                ->addColumn('action', function ($row) use ($banca) {    
                    if($row->lob_estado)
                    {
                      $estado = " btn-danger";
                      $mensaje = "Inactivar Loteria";
                    }else{
                        $estado = " btn-success";
                        $mensaje = "Activar Loteria";
                    }
                        return  '<button type="button"  data-href="'. action('BancaSuperPaleController@activarDesactivarBancaLoteriaSuper', [$row->id, $banca->id ]).'" class="btn btn-sm activar-inactivar-loteria'. $estado .'"><i class="fa fa-power-off"></i> '.$mensaje.'</button>';
                })

                ->rawColumns(['action'])
                ->make(true);
        } 
        return view('ajustesBanca.superpale.index')->with(['banca' => $banca]);

    }


    public function activarDesactivarBancaLoteriaSuper($loterias_id, $bancas_id)
    {
         
        $data['loterias_id'] = $loterias_id;
        $data['bancas_id'] = $bancas_id;
        $data['empresas_id'] = session()->get('user.emp_id');

        $estado = $this->marketService->getBancaLoteriaSuperEstado($data);

        return json_encode($estado);

    }
}
