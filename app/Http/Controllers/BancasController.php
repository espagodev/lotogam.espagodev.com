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
        // $data['empresas_id'] = $this->marketService->getUserInformation()->idEmpresa;
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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

        $banca_config_show = $this->util->bancaConfigShow();

        foreach ($banca_config_show as  $key => $value) {
            if (!isset($data[$key])) {
                $data[$key] = $value;
            }
        }

        $this->marketService->ModificarBanca($id, $data);

        return redirect()
            ->back(

            )
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
}
