<?php

namespace App\Http\Controllers;

use App\Services\MarketService;
use Illuminate\Http\Request;

class TiposDocumentoController extends Controller
{
    public function __construct(MarketService $marketService)
    {
        $this->middleware('auth');

        parent::__construct($marketService);
    }

    public function index()
    {
        $documentos = $this->marketService->getTipoDocumento();
        return view('tiposDocumento.index')->with(['documentos' => $documentos]);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data = $this->marketService->nuevoTipoDocumento($data);

        return redirect()
            ->route(
            'tiposDocumento.index'
            )
            ->with('success', ['Tipo de Documento Creado Satisfactoriamente']);
    }

    public function update(Request $request)
    {
        $id =  $request->input('tiposdocumento_id');
        $data['doc_abreviado'] =  $request->input('doc_abreviado');
        $data['doc_nombre'] =  $request->input('doc_nombre');


        $data = $this->marketService->ModificarTipoDocumento($id, $data);

        return redirect()
            ->route(
            'tiposDocumento.index'
            )
            ->with('success', ['Tipo de Documento Modificado Satisfactoriamente']);
    }
}
