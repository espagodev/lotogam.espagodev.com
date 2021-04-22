<?php

namespace App\Http\Controllers;

use App\Services\MarketService;
use Illuminate\Http\Request;

class MediosPagoController extends Controller
{
    public function __construct(MarketService $marketService)
    {
        $this->middleware('auth');

        parent::__construct($marketService);
    }

    public function index()
    {
        $mediosPago = $this->marketService->getMediosPago();
        return view('mediosPago.index')->with(['mediosPago' => $mediosPago]);
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $data = $this->marketService->nuevoMedioPago($data);

        return redirect()
            ->route(
            'mediosPago.index'
            )
            ->with('success', ['El metodo de pago se ha creado Satisfactoriamente']);
    }

    public function update(Request $request)
    {
        $id =  $request->input('mediopago_id');
        $data['mep_abreviado'] =  $request->input('mep_abreviado');
        $data['mep_nombre'] =  $request->input('mep_nombre');


        $data = $this->marketService->ModificarMediosPago($id, $data);

        return redirect()
            ->route(
            'mediosPago.index'
            )
            ->with('success', ['El metodo de pago se ha  Modificado Satisfactoriamente']);
    }
}
