<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsuariosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $empresa = session()->get('user.emp_id');

        $usuarios  = $this->marketService->getUsuariosEmpresa($empresa);

        return view('usuarios.index')->with(['usuarios' => $usuarios]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $empresa = session()->get('user.emp_id');


        $documentos = $this->marketService->getTipoDocumento();
        $bancas = $this->marketService->getBancasEmpresa($empresa);



        return view('usuarios.create')->with([ 'documentos' => $documentos, 'bancas' => $bancas]);
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
        $data['empresas_id'] =  session()->get('user.emp_id');
        $data['use_tipo'] = '3';
        $data = $this->marketService->nuevoUsuario($data);

        return redirect()
            ->route(
                'usuarios.index'
            )
            ->with('success', ['Banca Creada Satisfactoriamente']);
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
        $empresa = session()->get('user.emp_id');


        $documentos = $this->marketService->getTipoDocumento();
        $bancas = $this->marketService->getBancasEmpresa($empresa);
        $usuario = $this->marketService->getUsuario($id);

        return view('usuarios.edit')->with(compact('usuario','documentos','bancas'));
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


        $this->marketService->ModificarUsuario($id, $data);

        return redirect()
            ->route(
                'usuarios.index'
            )
            ->with('success', ['El usuario se ha modificado Satisfactoriamente']);
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
