<?php

namespace App\Http\Controllers;

use App\Services\MarketService;
use Illuminate\Http\Request;

class BancaMontoIndividualController extends Controller
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
        $empresa = session()->get('user.emp_id');

        $banca  = $this->marketService->getBancaDetalle($banca);

        $montosIndividualBancas  = $this->marketService->getMontosIndividualesBanca($banca->id);

        $montosIndividuales  = $this->marketService->getMontosIndividualesEmpresa($empresa);

        $modalidades  = $this->marketService->getModalidades();

        return view('ajustesBanca.montosI.index')->with(['banca' => $banca,'modalidades' => $modalidades, 'montosIndividualBancas' => $montosIndividualBancas, 'montosIndividuales' => $montosIndividuales]);
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

        $data = $this->marketService->nuevoMontoIndividualBanca($data);

        //  return redirect()
        //     ->route(
        //     'bancas.index'
        //     )
        // ->with(['banca' => $banca])
        return back()    ;
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
