<?php

namespace App\Http\Controllers;

use App\ConfigEmpresa\ConfigEmpresa;
use Illuminate\Http\Request;
use App\Services\MarketService;
use App\Utils\Util;

class ImpresoraPosController extends Controller
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

    /**
     * return page with loteria details
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $empresas_id  =  session()->get('user.emp_id');
        $impresoras  = $this->marketService->getImpresorasEmpresa($empresas_id);
        $conexiones = Util::tipoConexion();
        $capacidades = Util::perfilCapacidad();
        // $impresoras  = $this->marketService->getImpresoras();
        return view('ajustes/impresoraPos.index')->with(['impresoras' => $impresoras , 'conexiones' => $conexiones, 'capacidades' =>$capacidades]);
    }

    public function store(Request $request)
    {

        $data = $request->all();

        $data['empresas_id'] = session()->get('user.emp_id');
        $data = $this->marketService->nuevaImpresora($data);

        return redirect()
            ->route(
            'impresoraPos.index')
            ->with('success', ['Impresora Creada Satisfactoriamente']);
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

        $this->marketService->ModificarImpresora($id, $data);

        return redirect()
            ->route(
            'impresoraPos.index'
            )
            ->with('success', ['La Impresora se ha modificado Satisfactoriamente']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getModificarImpresoraPos($id)
    {

        $empresas_id = session()->get('user.emp_id');
        $impresora = $this->marketService->getImpresoraDetalle($empresas_id, $id);
 
        $conexiones = Util::tipoConexion();
        $capacidades = Util::perfilCapacidad();


        return view('ajustes.impresoraPos.impresorapos_modificar')->with(['impresora' => $impresora,  'conexiones' => $conexiones, 'capacidades' => $capacidades]);
    }

    public function getImpresoraBanca()
    {
        $ban_url  =  session()->get('banca.ban_url');
        $banca  = $this->marketService->getBancaDetalle($ban_url);

        $empresa  =  session()->get('user.emp_id');
        $impresoras = $this->marketService->getImpresorasEmpresa($empresa);       
        $tipoImpresoras = ConfigEmpresa::tipoImpresora();


        return view('impresora.modal')->with([ 'banca' => $banca,  'impresoras' => $impresoras,  'tipoImpresoras' => $tipoImpresoras]);
    }
}
