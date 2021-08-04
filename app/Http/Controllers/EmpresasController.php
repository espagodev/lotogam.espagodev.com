<?php

namespace App\Http\Controllers;

use App\ConfigEmpresa\ConfigEmpresa;
use App\ConfigFacturas\ConfigFacturas;
use App\Services\MarketService;
use App\Utils\Util;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EmpresasController extends Controller
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

    public function index()
    {
        $empresas = $this->marketService->getEmpresas();

        return view('empresas.index')->with(['empresas' => $empresas]);
    }

    public function create()
    {
        $now = Carbon::now();
        $fechaInicial = $now->format('Y-m-d');
        //SOLICITUDES GET A LA API
        $documentos = $this->marketService->getTipoDocumento();
        $planes = $this->marketService->getPlanes();
        $mediopagos = $this->marketService->getMediosPago();
        $monedas = $this->marketService->getMonedas();

        //HELPER
        $codigoEmpresa =  ConfigEmpresa::codigoEmpresa();
        $codigoFactura =  ConfigFacturas::codigoFactura();
        $descuento = ConfigFacturas::descuento();
        $impuesto = ConfigFacturas::impuesto();
        $zonasHoraria = ConfigEmpresa::zonaHoraria();
        $formatoFechas = ConfigEmpresa::formatoFecha();
        $formatoHoras = ConfigEmpresa::formatoHora();
        $ubicacionSiombolos = ConfigEmpresa::ubicacionSimboloMoneda();

        return view('empresas.create')->with(compact('documentos', 'planes', 'mediopagos', 'codigoFactura', 'codigoEmpresa', 'fechaInicial','descuento', 'impuesto','zonasHoraria','monedas','formatoFechas',
            'formatoHoras',
            'ubicacionSiombolos'));
    }

    public function store(Request $request)
    {
        $data = $request->all();

        if ($request->hasFile('emp_imagen')) {
            $data['emp_imagen'] = fopen($request->emp_imagen->path(), 'r');
        }

        $data = $this->marketService->nuevaEmpresa($data);

        return redirect()
            ->route(
                'empresas.index'
            )
            ->with('success', ['Empresa Creada Satisfactoriamente']);
    }

    public function edit($id)
    {

        //SOLICITUDES GET A LA API
        $documentos = $this->marketService->getTipoDocumento();
        $monedas = $this->marketService->getMonedas();
        $empresa = $this->marketService->getEmpresaDetalle($id);
        //HELPER
        $zonasHoraria = ConfigEmpresa::zonaHoraria();
        $formatoFechas = ConfigEmpresa::formatoFecha();
        $formatoHoras = ConfigEmpresa::formatoHora();
        $ubicacionSiombolos = ConfigEmpresa::ubicacionSimboloMoneda();
        // dd($empresa,$documentos,$monedas,$zonasHoraria,$formatoFechas,$formatoHoras,$ubicacionSiombolos);
        return view('empresas.edit')->with(compact('empresa',
            'documentos',
            'zonasHoraria',
            'monedas',
            'formatoFechas',
            'formatoHoras',
            'ubicacionSiombolos'
        ));
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

        if ($request->hasFile('emp_imagen')) {
        $data['emp_imagen'] = fopen($request->emp_imagen->path(), 'r');
        }

        $this->marketService->ModificarEmpresa($id, $data);

        return redirect()
            ->route(
                'empresas.index'
            )
            ->with('success', ['La Banca se ha modificado Satisfactoriamente']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function ajustesComunes()
    {
        $empresas_id = session()->get('user.emp_id');
        $empresa = $this->marketService->getEmpresaDetalle($empresas_id);

        $registrosPorPagina = Util::registrosPorPagina();
        $themeColors = Util::themeColors();

        $emp_ajustes_comunes = !empty($empresa->emp_ajustes_comunes) ? $empresa->emp_ajustes_comunes : [];

        return view('ajustes.ajustesComunes.index')->with(compact('registrosPorPagina', 'themeColors', 'emp_ajustes_comunes'));
    }
}


