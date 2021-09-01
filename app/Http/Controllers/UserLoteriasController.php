<?php

namespace App\Http\Controllers;

use App\Utils\HorarioLoterias;
use App\Utils\Util;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class UserLoteriasController extends Controller
{

    public function loterias($users_id)
    {       
        
        if (request()->ajax()) {

            $loteriasusuario  = $this->marketService->getLoteriasUserFaltantes($users_id);
            
            return DataTables::of($loteriasusuario)
            ->addColumn('horario', function ($row) {
                    if ($row->lou_estado != null) { 
                        return '<button type="button" data-href="' . action('UserLoteriasController@getModificarHorarioUser', [$row->id, $row->users_id]) . '"  class="btn btn-sm btn-outline-info btn-modal"
                        data-container=".view_register"><i class="fa fa-clock-o"></i> </button>
                            ';
                    }
                })
            ->addColumn('action', function ($row) use ($users_id) {    
                    if($row->lou_estado)
                    {
                    $estado = " btn-danger";
                      $mensaje = "Inactivar Loteria";
                    }else{
                        
                        $estado = " btn-success";
                        $mensaje = "Activar Loteria";
                    }
                        return  '<button type="button"  data-href="'. action('UserLoteriasController@activarDesactivarUserLoteria', [$row->id, $users_id ]).'" class="btn btn-sm activar-inactivar-loteria'. $estado .'"><i class="fa fa-power-off"></i> '.$mensaje.'</button>';
                })

                ->rawColumns(['action', 'horario'])
                ->make(true);
        }

        
        return view('usuarios.loterias')->with(['users_id' => $users_id]);
    }

    public function store(Request $request)
    {

        $data = $request->all();
        $data['empresas_id'] = session()->get('user.emp_id');
        
        $data = $this->marketService->nuevoHorarioLoteria($data);

        return back();
    }

    public function update(Request $request,  $loteria){

        $data = $request->all();
        $data = $request->except('_token');
        $data['loterias_id'] = $loteria; 
        $data['empresas_id'] = session()->get('user.emp_id');

    
         $data = HorarioLoterias::getActualizarHorarioUsuarioLoteria($loteria, $data);

        return back()
            ->with('success', ['El Horario se ha Modificado Satisfactoriamente']);
    }



    public function getModificarHorarioUser($loteria, $users_id)
    {       
       
        $loteria = $this->marketService->getLoteria($loteria);
     
        $sorteos = json_decode($loteria->lot_sorteo, true);

        $horarios = HorarioLoterias::UsuarioHorario($users_id, $loteria->id);
        $dias = Util::dias();

        return view('usuarios.modal_edit')->with(compact('loteria', 'dias','sorteos', 'horarios','users_id'));
    }

    public function activarDesactivarUserLoteria($loterias_id, $users_id){


        $data['loterias_id'] = $loterias_id;
        $data['users_id'] = $users_id;
        $data['empresas_id'] = session()->get('user.emp_id');

        $estado = $this->marketService->getUserLoteriaEstado($data);


        return json_encode($estado);

    }

}
