<?php

namespace App\Http\Controllers;

use App\Services\MarketService;
use Illuminate\Http\Request;

class ModalidadesController extends Controller
{
    public function __construct(MarketService $marketService)
    {
        $this->middleware('auth');

        parent::__construct($marketService);
    }

    public function index()
    {
        $modalidades = $this->marketService->getModalidades();
        return view('modalidades.index')->with(['modalidades' => $modalidades]);
    }

    public function store(Request $request)
    {
        $rules = [
            'mod_nombre' => 'required',
            'mod_abreviado' => 'required'
        ];

        $data = $this->validate($request, $rules);

        $data = $this->marketService->nuevaModalidad($data);

        return redirect()
            ->route(
                'modalidades.index'
            )
            ->with('success', ['Modalidad Creada Satisfactoriamente']);
    }

    public function update(Request $request)
    {
        $id =  $request->input('modalidades_id');
        $data['mod_abreviado'] =  $request->input('mod_abreviado');
        $data['mod_nombre'] =  $request->input('mod_nombre');


        $data = $this->marketService->ModificarModalidades($id, $data);

        return redirect()
            ->route(
            'modalidades.index'
            )
            ->with('success', ['Modalidad  Modificada Satisfactoriamente']);
    }
}
