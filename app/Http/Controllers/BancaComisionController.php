<?php

namespace App\Http\Controllers;

use App\Services\MarketService;
use Illuminate\Http\Request;

class BancaComisionController extends Controller
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

        $comisiones  = $this->marketService->getComisionesEmpresa($empresas_id);

        return view('ajustesBanca.comisiones.index')->with(compact('banca','comisiones'));
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
        $data['modalidades_id']  = $request->modalidades_id;

        $data = $this->marketService->nuevaComisionBanca($data);

        return back();

    }

}
