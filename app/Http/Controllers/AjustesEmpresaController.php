<?php

namespace App\Http\Controllers;

use App\ConfigEmpresa\ConfigEmpresa;
use App\Services\MarketService;
use Illuminate\Http\Request;

class AjustesEmpresaController extends Controller
{
    public function __construct(MarketService $marketService)
    {
        $this->middleware('auth');

        parent::__construct($marketService);
    }
    public function index()
    {
        $data = session()->get('user.emp_id');
        $empresa  = $this->marketService->getEmpresaDetalle($data);
        $comisiones  = $this->marketService->getComisionesEmpresa($data);
        $montosGlobales  = $this->marketService->getMontosGlobalesEmpresa($data);
        $montosIndividuales = $this->marketService->getMontosIndividualesEmpresa($data);
        $numerosCalientes = $this->marketService->getNumerosCalientesEmpresa($data);

        //SOLICITUDES GET A LA API
        $documentos = $this->marketService->getTipoDocumento();
        $monedas = $this->marketService->getMonedas();
        //HELPER
        $zonasHoraria = ConfigEmpresa::zonaHoraria();
        $formatoFechas = ConfigEmpresa::formatoFecha();
        $formatoHoras = ConfigEmpresa::formatoHora();
        $ubicacionSiombolos = ConfigEmpresa::ubicacionSimboloMoneda();

        return view('ajustes/empresas.index')->with(compact('empresa', 'comisiones', 'montosGlobales', 'montosIndividuales', 'numerosCalientes',
            'documentos',
            'zonasHoraria',
            'monedas',
            'formatoFechas',
            'formatoHoras',
            'ubicacionSiombolos'));
        //  return view('ajustes/empresas.index');
    }
}
