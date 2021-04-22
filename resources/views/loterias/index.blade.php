@extends('layouts.app')
    @section('content')
     <div class="row pt-2 pb-2">
        <div class="col-sm-9">
		    <h4 class="page-title">Loterias</h4>
	   </div>
        <div class="col-sm-3">
            <div class="btn-group float-sm-right">
                <button type="button" class="btn btn-primary waves-effect waves-primary" data-toggle="modal" data-whatever="Nueva Loteria" data-botton="Guardar" data-target="#nuevo"><i class="fa fa-plus mr-1"></i> Nueva Loteria</button>
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
                                            <th scope="col">Logo</th>
                                            <th scope="col">Nombre Loteria</th>
                                            <th scope="col">Abreviado</th>
                                            <th scope="col">Estado</th>
                                            <th scope="col">Opciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($loterias as $key => $loteria)
                                        <tr>
                                            {{-- @dump($loteria) --}}
                                            <td>
                                                <div class="media align-items-center">
                                                     <img src="{{$loteria->imagen}}" class="customer-img rounded">
                                                </div>
                                            </td>
                                            <td>{{ $loteria->loteria }}</td>
                                            <td>{{ $loteria->abreviado }}</td>
                                           <td  class="card-body bt-switch">
                                                <input type="checkbox" data-id="{{$loteria->identificador}}"  data-size="small" data-on-color="success" data-off-color="default" data-on-text="<i class='fa fa-check-circle-o'></i>" data-off-text="<i class='fa  fa-ban'></i>" {{ $loteria->estado ? 'checked' : '' }}>
                                            </td>
                                            <td>
                                                <a href="#" data-toggle="modal"  data-target="#actualizar" data-whatever="Actualizar Loteria"  data-botton="modificar" data-id="{{ $loteria->identificador }}"  class="btn btn-outline-warning"> <i class="fa fa-pencil"></i></a>
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
   @include("loterias.partials._from")
