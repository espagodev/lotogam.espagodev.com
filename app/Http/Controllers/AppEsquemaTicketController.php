<?php

namespace App\Http\Controllers;

use App\Utils\Util;
use Illuminate\Http\Request;

class AppEsquemaTicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $empresa = request()->session()->get('user.emp_id');
        $ticketEsquemas =  $this->marketService->getAppEsquemaTicketsEmpresa($empresa);

        $totalDigitos = Util::totalDigitos();
        return view('ajustes.ajustesTicket.index')->with(compact('ticketEsquemas', 'totalDigitos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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

        $data = $this->marketService->nuevaAppEsquemaTickets($data);

        return redirect()
            ->route(
            'ajustesTicket.index'
            )
            ->with('success', ['El esquema  se ha creado Satisfactoriamente']);
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
