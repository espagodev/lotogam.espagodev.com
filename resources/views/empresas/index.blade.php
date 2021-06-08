@extends('layouts.app')
@section('title', 'Listado de Empresas')
    @section('content')
     <div class="row pt-2 pb-2">
        <div class="col-sm-9">
		    <h4 class="page-title">Listado de Empresas</h4>
	   </div>
        <div class="col-sm-3">
            <div class="btn-group float-sm-right">
                <a href="{{ route('empresas.create') }}"  class="btn btn-primary waves-effect waves-primary"><i class="fa fa-plus mr-1"></i> Crear Empresa</a>
            </div>
        </div>
     </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Nombre Empresa</th>
                                            <th scope="col">Telefono</th>
                                            <th scope="col">Direccion</th>
                                            <th scope="col">Estado</th>
                                            <th scope="col">Opciones</th>
                                        </tr>

                                    </thead>
                                    <tbody>
                                        @foreach($empresas as $key => $empresa)
                                        <tr>
                                            <td>{{ $empresa->emp_nombre }}</td>
                                            <td>{{ $empresa->emp_telefono }}</td>
                                            <td>{{ $empresa->emp_direccion }}</td>
                                             <td  class="bt-switch">
                                                <input type="checkbox" data-id="{{$empresa->id}}" {{ $empresa->emp_estado ? 'checked' : '' }} data-size="small" data-on-color="success" data-off-color="default" data-on-text="<i class='fa fa-check-circle-o'></i>" data-off-text="<i class='fa  fa-ban'></i>" >
                                            </td>
                                            <td>
                                                <a href="{{route('empresas.edit',$empresa->id)}}" class="btn btn-outline-warning" rel="tooltip" title="Editar empresa" >
                                                    <i class="fa fa-pencil"></i>
                                                </a>

                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                    </div>
                </div>
            </div>
      </div><!--End Row-->
   @endsection

