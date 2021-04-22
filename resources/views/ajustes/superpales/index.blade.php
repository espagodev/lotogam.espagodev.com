@extends('layouts.app')
    @section('content')
     <div class="row pt-2 pb-2">
        <div class="col-sm-9">
		    <h4 class="page-title">Ajustes Empresa</h4>
		{{-- <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javaScript:void();">Bulona</a></li>
            <li class="breadcrumb-item"><a href="javaScript:void();">Pages</a></li>
            <li class="breadcrumb-item active" aria-current="page">Blank Page</li>
        </ol> --}}
	   </div>
        <div class="col-sm-3">
            <div class="btn-group float-sm-right">
                <button type="button" class="btn btn-primary waves-effect waves-primary" data-toggle="modal" data-target="#nuevo"><i class="fa fa-plus mr-1"></i> Nueva Loteria SuperPale</button>
                {{-- <button type="button" class="btn btn-light dropdown-toggle dropdown-toggle-split waves-effect waves-light" data-toggle="dropdown">
                <span class="caret"></span>
                </button>
                <div class="dropdown-menu">
                <a href="javaScript:void();" class="dropdown-item">Action</a>
                <a href="javaScript:void();" class="dropdown-item">Another action</a>
                <a href="javaScript:void();" class="dropdown-item">Something else here</a>
                <div class="dropdown-divider"></div>
                <a href="javaScript:void();" class="dropdown-item">Separated link</a>
                </div> --}}
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
                                            <th scope="col">Loteria</th>
                                            <th scope="col">Combinación</th>
                                            <th scope="col">Abreviado</th>
                                            <th scope="col">Estado</th>

                                        </tr>
                                    </thead>
                                     <tbody>
                                                @foreach($superPales as $key => $superpale)
                                                    @if($superpale->lot_superpale == '1')
                                                        <tr>
                                                            <td>{{ $superpale->lot_nombre}}</td>

                                                            <td>
                                                                {{-- @if(!empty($superpales->getLoteriaName()))
                                                                    @foreach($superpales->getLoteriaName() as $valor)
                                                                        <label>{{ $valor->lot_nombre }}</label>
                                                                    @endforeach
                                                                @endif --}}
                                                            </td>
                                                            <td>{{ $superpale->lot_abreviado}} </td>
                                                        <td  class="card-body bt-switch">
                                                                <input type="checkbox" data-id="{{$superpale->loterias_id}}" {{ $superpale->lot_estado ? 'checked' : '' }} data-size="small" data-on-color="success" data-off-color="default" data-on-text="<i class='fa fa-check-circle-o'></i>" data-off-text="<i class='fa  fa-ban'></i>" >
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @endforeach
                                            </tbody>
                                </table>
                            </div>
                    </div>
                </div>
            </div>
      </div><!--End Row-->
   @endsection
    @section('styles')
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}"/>
     @endsection
   @section('scripts')
  <script src="{{ asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <script>
         $(document).ready(function() {
            $('.multiple-select').select2();
        });
    </script>
   @endsection
   <div class="modal fade" id="nuevo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Agregar Nueva Loteria SuperPale</h4><button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('superPaleEmpresa.store')}}" id="store">
                    @include('ajustes.superpales.form')
                </div>
                <div class="modal-footer"><button class="btn btn-danger" type="button" data-dismiss="modal">Cancelar</button>
                    <button class="btn btn-primary" type="submit">Crear</button></div>
            </div>
            </form>
        </div>
    </div>
