<?php

namespace App\Http\Controllers;

use App\Services\MarketService;
use App\ConfigEmpresa\ConfigEmpresa;
use Illuminate\Http\Request;

class LoteriasController extends Controller
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
        $loterias = $this->marketService->getLoterias();


        return view('loterias.index')->with(['loterias' => $loterias]);
    }

    public function store(Request $request)
    {

        // $rules = [
        //     'lot_codigo' => 'required',
        //     'lot_nombre' => 'required',
        //     'lot_abreviado' => 'required'
        // ];

        // $horaSorteo = $request->input('sorteo');
        // $data['lot_sorteo'] = json_encode($horaSorteo);
        // $data = $this->validate($request, $rules);
        $data = $request->only('lot_nombre','lot_abreviado','lot_zona_horaria');
      

        if ($request->hasFile('lot_imagen')) {
            $data['lot_imagen'] = fopen($request->lot_imagen->path(), 'r');
          
        }
        
        $data = $this->marketService->nuevaLoteria($data);

        return redirect()
            ->route(
            'loterias.index')
            ->with('success', ['Loteria Creada Satisfactoriamente']);
    }

    public function update(Request $request, $id)
    {
       
        $sorteos = $request->input('sorteo');

        // $data = $request->all();
        // $data = $request->except('_token');
        $data['lot_nombre'] =  $request->input('lot_nombre');
        $data['lot_abreviado'] =  $request->input('lot_abreviado');
        $data['lot_codigo'] =  $request->input('lot_codigo');

        if ($request->hasFile('lot_imagen')) {
            $data['lot_imagen'] = fopen($request->lot_imagen->path(), 'r');
        }
        // $data['lot_sorteo'] = json_encode($sorteos);


        $this->marketService->ModificarLoteria($id, $data);

        return redirect()
            ->route(
                'loterias.index'
            )
            ->with('success', ['Loteria Modificada Satisfactoriamente']);
    }

    public function getNuevaLoteria()
    {
        $countLoterias = $this->marketService->getTotalLoterias();
        $totalLoterias = json_decode($countLoterias);
        $zonasHoraria = ConfigEmpresa::zonaHoraria();

        return view('loterias.modal_create')->with(['zonasHoraria' => $zonasHoraria, 'totalLoterias' => $totalLoterias ]);
    }

    public function getModificarLoteria($id) 
    {
        $zonasHoraria = ConfigEmpresa::zonaHoraria();
        $loteria = $this->marketService->getLoteria($id);
        $sorteos = json_decode($loteria->lot_sorteo, true);

        return view('loterias.modal_edit')->with(['loteria' => $loteria,'sorteos' => $sorteos,'zonasHoraria' => $zonasHoraria]);
    }
}
