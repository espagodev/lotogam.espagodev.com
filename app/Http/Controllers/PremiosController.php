<?php

namespace App\Http\Controllers;

use App\Services\MarketService;
use Illuminate\Http\Request;

class PremiosController extends Controller
{
    public function __construct(MarketService $marketService)
    {
        $this->middleware('auth');

        parent::__construct($marketService);
    }

    public function index()
    {
        $modalidades = $this->marketService->getModalidades();
        $premios = $this->marketService->getPremios();

        return view('ajustes/premios.index')->with(['premios' => $premios,'modalidades' => $modalidades]);
    }

     public function create()
    {
        return view('ajustes/premios.create');
    }

    public function store(Request $request)
    {


        $quiniela = $request->input('quiniela');
        $pale = $request->input('pale');
        $tripleta = $request->input('tripleta');
        $superpale = $request->input('superpale');

        $data['pre_nombre'] =  $request->input('pre_nombre');
        $data['empresas_id'] =  request()->session()->get('user.emp_id');
        $data['pre_quiniela'] = json_encode($quiniela);
        $data['pre_pale'] = json_encode($pale);
        $data['pre_tripleta'] = json_encode($tripleta);
        $data['pre_super'] = json_encode($superpale);

        $data = $this->marketService->nuevoPremio($data);

        return redirect()
            ->route(
            'premios.index'
            )
            ->with('success', ['El Premio se ha creado Satisfactoriamente']);
    }

    public function edit($id)    {
        $premio = $this->marketService->getPremio($id);
    return view('ajustes/premios.edit')->with(compact('premio'/*,'quiniela', 'pale', 'tripleta', 'superpale'*/));
    }

    public function update(Request $request, $id)
    {

        $quiniela = $request->input('quiniela');
        $pale = $request->input('pale');
        $tripleta = $request->input('tripleta');
        $superpale = $request->input('superpale');

        // $data = $request->except('_token');
        $data['pre_nombre'] =  $request->input('pre_nombre');
        $data['pre_quiniela'] = json_encode($quiniela);
        $data['pre_pale'] = json_encode($pale);
        $data['pre_tripleta'] = json_encode($tripleta);
        $data['pre_super'] = json_encode($superpale);


        $this->marketService->ModificarPremio($id, $data);

        return redirect()
            ->route(
                'premios.index'
            )
            ->with('success', ['El Premio se ha creado Satisfactoriamente']);
    }
}
