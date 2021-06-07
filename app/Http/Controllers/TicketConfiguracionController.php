<?php

namespace App\Http\Controllers;

use App\ConfigEmpresa\ConfigEmpresa;
use App\Services\MarketService;
use Illuminate\Http\Request;

use App\Utils\Util;

class TicketConfiguracionController extends Controller
{

    protected $util;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Util $util, MarketService $marketService)
    {
        $this->util = $util;
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
        $empresa = request()->session()->get('user.emp_id');
        $ticketConfiguracion =  $this->marketService->getAppConfigTicketsEmpresa($empresa);
        return view('ajustes.formatoTicket.index')->with(compact('ticketConfiguracion'));
        // return view('ajustes.tickets.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $formatos = $this->util->formatoBrowser();
        $formatoFechas = ConfigEmpresa::formatoFecha();
        return view('ajustes.formatoTicket.create')->with(compact('formatoFechas','formatos'));
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

        $data['empresas_id'] =  request()->session()->get('user.emp_id');

        $data['tcon_logo'] = fopen($request->tcon_logo->path(), 'r');

        $data = $this->marketService->nuevaAppConfigTickets($data);


        return redirect()
            ->route(
            'formatoTicket.index'
            )
            ->with('success', ['El se ha creado Satisfactoriamente']);

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
        $formatoFechas = ConfigEmpresa::formatoFecha();
        $formatos = $this->util->formatoBrowser();
        $formato = $this->marketService->getAppConfigTickets($id, $layout_id = null );

        return view('ajustes.formatoTicket.edit')->with(compact('formato', 'formatoFechas', 'formatos'));
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

        $ticket_config_show = $this->util->ticketConfigShow();

        foreach ($ticket_config_show as  $key => $value) {
            if (!isset($data[$key])) {
                $data[$key] = $value;
            }
        }

        if ($request->hasFile('tcon_logo')) {
            $data['tcon_logo'] = fopen($request->tcon_logo->path(), 'r');
        }

        $this->marketService->ModificarAppConfigTickets($id, $data);

        return redirect()
            ->route(
                'formatoTicket.index'
            )
            ->with('success', ['La configuracion se ha modificado Satisfactoriamente']);
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
