<?php

namespace App\Http\Controllers;

use App\ConfigEmpresa\ConfigEmpresa;
use App\Services\MarketService;
use Illuminate\Http\Request;

class BancaImpresoraPosController extends Controller
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
    public function index($banca)
    {
        $banca  = $this->marketService->getBancaDetalle($banca);

        $empresa  =  session()->get('user.emp_id');

        $impresoras = $this->marketService->getImpresorasEmpresa($empresa);
        $esquemas = $this->marketService->getAppEsquemaTicketsEmpresa($empresa);
        $configuraciones = $this->marketService->getAppConfigTicketsEmpresa($empresa);

        $tipoImpresoras = ConfigEmpresa::tipoImpresora();
        $impresionAutomaticas = ConfigEmpresa::impresionAutomatica();

        return view('ajustesBanca.impresoraPos.index')->with(['banca' => $banca, 'impresoras' => $impresoras, 'esquemas' => $esquemas, 'configuraciones' => $configuraciones, 'tipoImpresoras' => $tipoImpresoras, 'impresionAutomaticas' => $impresionAutomaticas]);
    }

}
