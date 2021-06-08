<?php

namespace App\Http\Controllers;

use App\ConfigEmpresa\ConfigEmpresa;
use Illuminate\Http\Request;
use App\Services\MarketService;

use App\Utils\Util;

class AjustesBancaController extends Controller
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
   public function index($banca)
    {

        $banca  = $this->marketService->getBancaDetalle($banca);
        $empresa = session()->get('user.emp_id');
        $monedas = $this->marketService->getMonedas();
        $impresoras = $this->marketService->getImpresorasEmpresa($empresa);
        $esquemas = $this->marketService->getAppEsquemaTicketsEmpresa($empresa);
        $configuraciones = $this->marketService->getAppConfigTicketsEmpresa($empresa);
        $zonasHoraria = ConfigEmpresa::zonaHoraria();
        $premios = $this->marketService->getPremiosEmpresa($empresa);

        $documentos = $this->marketService->getTipoDocumento();


        return view('ajustesBanca.index')->with(compact('documentos', 'banca' , 'zonasHoraria' , 'monedas', 'impresoras' , 'esquemas' , 'configuraciones' , 'premios'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function bancaAjustes($banca)
    {

        $banca  = $this->marketService->getBancaDetalle($banca);
        $empresa = session()->get('user.emp_id');

        $monedas = $this->marketService->getMonedas();
        $impresoras = $this->marketService->getImpresorasEmpresa($empresa);
        $esquemas = $this->marketService->getAppEsquemaTicketsEmpresa($empresa);
        $configuraciones = $this->marketService->getAppConfigTicketsEmpresa($empresa);
        $zonasHoraria = ConfigEmpresa::zonaHoraria();
        $premios = $this->marketService->getPremiosEmpresa($empresa);

        $documentos = $this->marketService->getTipoDocumento();


        return view('ajustesBanca.ajustes.adicionales')->with(compact('documentos', 'banca', 'zonasHoraria', 'monedas', 'impresoras', 'esquemas', 'configuraciones', 'premios'));
    }


    public function updateAjustesImpresion(Request $request, $id)
    {
        $data = $request->all();
        $data = $request->except('_token');

        $this->marketService->ModificarBanca($id, $data);

        return redirect()
            ->back()
            ->with('success', ['Ajustes de Impresion de la Banca Modificados']);
    }

    public function updateAjustesAdicionales(Request $request, $id)
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
            ->back()
            ->with('success', ['Ajustes Adicionales de la Banca Modficados']);
    }

}
