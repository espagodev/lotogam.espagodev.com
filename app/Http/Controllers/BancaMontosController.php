<?php

namespace App\Http\Controllers;

use App\Services\MarketService;
use Illuminate\Http\Request;

class BancaMontosController extends Controller
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
        $empresas_id = session()->get('user.emp_id');

        $banca  = $this->marketService->getBancaDetalle($banca);

        $montosGlobales  = $this->marketService->getMontosGlobalesEmpresa($empresas_id);
        $montosIndividuales  = $this->marketService->getMontosIndividualesEmpresa($empresas_id);

        return view('ajustesBanca.montos.index')->with([ 'banca' => $banca, 'montosGlobales' => $montosGlobales, 'montosIndividuales' => $montosIndividuales]);
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

        $data['bancas_id']  = $request->bancas_id;
        // $banca  = $this->marketService->getBancaDetalle($banca);

        $data = $this->marketService->nuevoMontoGlobalBanca($data);

        //  return redirect()
        //     ->route(
        //     'bancas.index'
        //     )
        // ->with(['banca' => $banca])
        return back();
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
        //
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
