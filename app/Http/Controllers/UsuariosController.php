<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MarketService;
use App\Utils\Util;
use Yajra\DataTables\Facades\DataTables;

class UsuariosController extends Controller
{
    protected $util;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Util $util, MarketService $marketService)
    {
        $this->util = $util;
        $this->middleware('auth');

        parent::__construct($marketService);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $empresa = session()->get('user.emp_id');

        $usuarios  = $this->marketService->getUsuariosEmpresa($empresa);

        return view('usuarios.index')->with(['usuarios' => $usuarios]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $empresa = session()->get('user.emp_id');


        $documentos = $this->marketService->getTipoDocumento();
        $bancas = $this->marketService->getBancasEmpresa($empresa);
        $horarios = Util::horarioUsuario();

        return view('usuarios.create')->with([ 'documentos' => $documentos, 'bancas' => $bancas, 'horarios'=>$horarios]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $data['empresas_id'] =  session()->get('user.emp_id');
        $data['use_tipo'] = '3';
        $data = $this->marketService->nuevoUsuario($data);

        return redirect()
            ->route(
                'usuarios.index'
            )
            ->with('success', ['Banca Creada Satisfactoriamente']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $empresa = session()->get('user.emp_id');


        $documentos = $this->marketService->getTipoDocumento();
        $bancas = $this->marketService->getBancasEmpresa($empresa);
        $usuario = $this->marketService->getUsuario($id);
        $horarios = Util::horarioUsuario();

        return view('usuarios.edit')->with(compact('usuario','documentos','bancas','horarios'));
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

        $user_config = $this->util->userConfigShow();

        foreach ($user_config as  $key => $value) {
            if (!isset($data[$key])) {
                $data[$key] = $value;
            }
        }
        $this->marketService->ModificarUsuario($id, $data);

        return redirect()
            ->route(
                'usuarios.index'
            )
            ->with('success', ['El usuario se ha modificado Satisfactoriamente']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getusuarios(Request $request)
    {
        try {
            $bancas_id = $request->input('bancas_id');
                $usuarios  = $this->marketService->getUsuariosBanca($bancas_id);
            // $response = ['data' => $areas];
        } catch (\Exception $exception) {
            return response()->json([ 'message' => 'Hubo un error al recuperar los registros.' ], 500);
        }
        return response()->json($usuarios);
    }

    public function getBancasSuperVisor($user_id)
    {
        $usuario = $this->marketService->getUsuario($user_id);

        $empresa = session()->get('user.emp_id');
        $bancas = $this->marketService->getBancasEmpresa($empresa);
        
        return view('usuarios.partials.modal')->with(compact('bancas','usuario'));
    }

    public function updatedSupervisor(Request $request, $id)
    {
        $data = $request->all();
        
        $this->marketService->ModificarBancasSupervisor($id, $data);

        return redirect()
            ->route(
                'usuarios.index'
            )
            ->with('success', ['Supervisor Actualizado Correctamente.']);
    }

}
