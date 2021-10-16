<?php

namespace App\Http\Controllers;

use App\ConfigEmpresa\ConfigEmpresa;
use Illuminate\Http\Request;
use App\Services\MarketService;

use App\Utils\Util;

class BancasController extends Controller
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
        $empresas_id = session()->get('user.emp_id');
        $bancas  = $this->marketService->getListaBancaEmpresa($empresas_id);

        return view('bancas.index')->with(['bancas' => $bancas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $empresas_id = session()->get('user.emp_id');
        $monedas = $this->marketService->getMonedas();

        $impresoras = $this->marketService->getImpresorasEmpresa($empresas_id);
        $esquemas = $this->marketService->getAppEsquemaTicketsEmpresa($empresas_id);
        $configuraciones = $this->marketService->getAppConfigTicketsEmpresa($empresas_id);
        $premios = $this->marketService->getPremiosEmpresa($empresas_id);

        $zonasHoraria = ConfigEmpresa::zonaHoraria();

        return view('bancas.create')->with(['zonasHoraria' => $zonasHoraria, 'monedas' => $monedas, 'impresoras'=>$impresoras, 'esquemas' => $esquemas, 'configuraciones' => $configuraciones, 'premios' => $premios]);
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

        $data = $this->marketService->nuevaBanca($data);

        return redirect()
            ->route(
                'bancas.index'
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

        $this->marketService->ModificarBanca($id, $data);

        return redirect()
            ->back()
            ->with('success', ['La Banca se ha modificado Satisfactoriamente']);
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

    public function getbancas(){

        try {
            $empresas_id = session()->get('user.emp_id');
            $bancas  = $this->marketService->getListaBancaEmpresa($empresas_id);

        } catch (\Exception $exception) {
            return response()->json(['message' => 'Hubo un error al recuperar los registros.'], 500);
        }
        return response()->json($bancas);
    }


    public function duplicarBanca($ban_url)
    {
        return view('bancas.modal_clonar')->with(['ban_url' => $ban_url]);

    }

    public function bancaDuplicada(Request $request)
    {
        $data = $request->all();
        $data = $request->except('_token');
        $data['empresas_id'] =  session()->get('user.emp_id');
        $data['ban_url'] = $request->ban_url;
        $data['ban_cod'] = $request->ban_cod;
        $data['ban_nombre'] = $request->ban_nombre;

        $banca = $this->marketService->getBancaDuplicar($data);
 
        return redirect()
            ->route('ajustesBanca', $banca->ban_url)
            ->with('success', ['Banca Duplicada Satisfactoriamente']);

    }
}
