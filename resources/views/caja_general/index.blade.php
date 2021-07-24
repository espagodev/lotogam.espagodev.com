@extends('layouts.app')
@section('title','Cuadre de Caja')
    @section('content')
            <div class="row pt-2 pb-2">
                <div class="col-sm-9">
                    <h4 class="page-title">Cuadre de Caja</h4>
                </div>
                 <div class="col-sm-3">
                    <div class="btn-group float-sm-right">
                        @if((request()->session()->get('user.TipoUsuario') == 2))
                        <a href="#" data-href="{{action('CajaGeneralController@create') }}"  class="btn btn-primary waves-effect waves-light nuevo-registro" rel="tooltip" title="ingresar Registro" ><i class="fa fa-plus m-1"></i>Nuevo Registro</a>
                        @endif
                    </div>
                </div>
            </div>
            @include('caja_general.partials.opciones')
            @include('caja_general.partials.detalles')

              <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-sm " id="caja_general">
                                    <thead>
                                        <tr>
                                            <th scope="col">Accion</th>
                                            <th scope="col">Fecha</th>
                                            <th scope="col">Banca</th>
                                            <th scope="col">Usuario</th>
                                            <th scope="col">Cantidad</th>
                                            <th scope="col">Motivo</th>
                                            <th scope="col">Opciones</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                    </div>
                </div>
            </div>
      </div><!--End Row-->
    <div class="modal fade nuevo_modal" tabindex="-1" role="dialog"
        aria-labelledby="gridSystemModalLabel">
    </div>
    @endsection
@section('scripts')
    <script src="{{ asset('js/cajaGeneral.js?v=' . $asset_v) }}"></script>
    <script src="{{ asset('js/select.js?v=' . $asset_v) }}"></script>
@endsection
