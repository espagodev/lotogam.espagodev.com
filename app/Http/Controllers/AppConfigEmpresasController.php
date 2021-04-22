<?php

namespace App\Http\Controllers;

use App\Services\MarketService;
use App\Utils\Util;
use Illuminate\Http\Request;

class AppConfigEmpresasController extends Controller
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
    public function index()
    {
        $appConfigEmpresas = $this->marketService->getAppConfigEmpresas();
        $appConfigFacturas = $this->marketService->getAppConfigFacturas();
        $totalDigitos = Util::totalDigitos();

        return view('appConfigEmpresas.index')->with(['appConfigEmpresas' => $appConfigEmpresas, 'appConfigFacturas' => $appConfigFacturas, 'totalDigitos' => $totalDigitos]);
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

        $data = $this->marketService->nuevaAppConfigEmpresas($data);

        return redirect()
            ->route(
            'appConfigEmpresas.index'
            )
            ->with('success', ['El metodo de pago se ha creado Satisfactoriamente']);
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
