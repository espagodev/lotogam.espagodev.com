<?php

namespace App\Http\Controllers;

use App\ConfigEmpresa\ConfigEmpresa;
use Illuminate\Http\Request;

class AjustesBancaController extends Controller
{
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

}
