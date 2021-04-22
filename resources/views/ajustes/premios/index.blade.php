@extends('layouts.app')
    @section('content')
     <div class="row pt-2 pb-2">
        <div class="col-sm-9">
		    <h4 class="page-title">Ajustes Empresa / Listado de Premios</h4>

	   </div>
        <div class="col-sm-3">
            <div class="btn-group float-sm-right">
                 <a href="{{ route('premios.create') }}"  class="btn btn-primary waves-effect waves-primary"><i class="fa fa-plus mr-1"></i> Crear Nuevo Premio</a>

            </div>
        </div>
     </div>

        <div class="row">
             <div class="col-lg-4">
                 @include('ajustes._sidebar')
            </div>
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Nombre</th>
                                            <th scope="col">Estado</th>
                                            <th scope="col">Opciones</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($premios as $key => $premio)
                                            <tr>
                                                <td>{{ $premio->pre_nombre}}</td>
                                                 <td  class="card-body bt-switch">
                                                    <input type="checkbox" data-id="{{$premio->id}}" {{ $premio->pre_estado ? 'checked' : '' }} data-size="small" data-on-color="success" data-off-color="default" data-on-text="<i class='fa fa-check-circle-o'></i>" data-off-text="<i class='fa  fa-ban'></i>" >
                                                </td>
                                                <td>
                                                    <a href="{{route('premios.edit',$premio->id)}}" class="btn btn-outline-warning" rel="tooltip" title="Editar Premios" >
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
         <div class="modal fade" id="nuevo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Agregar Nuevo Premio</h4><button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="{{ route('premios.store')}}">
                        @include('ajustes.premios.form')
                    </div>
                    <div class="modal-footer"><button class="btn btn-danger" type="button" data-dismiss="modal">Cancelar</button>
                        <button class="btn btn-primary" type="submit">Crear</button></div>
                </div>
                </form>
            </div>
        </div>
