@extends('layouts.app')
@section('title', 'Cuadre de Caja')
@section('content')
<div class="row pt-2 pb-2">
    <div class="col-sm-9">
        <h4 class="page-title">Cuadre de Caja</h4>
    </div>
    <div class="col-sm-3">
        <div class="btn-group float-sm-right">
            @if ((request()->session()->get('user.TipoUsuario') == 2) || (request()->session()->get('user.useCuadreCaja') == 1))
                <a href="#" data-href="{{ action('CajaGeneralController@create') }}"
                    class="btn btn-primary waves-effect waves-light nuevo-registro" rel="tooltip"
                    title="ingresar Registro"><i class="fa fa-plus m-1"></i>Nuevo Registro</a>
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
                <ul class="nav nav-tabs nav-tabs-primary">
                    <li class="nav-item active">
                        <a href="#balance_diario" class="nav-link" data-toggle="tab" ><span>Balances Diarios</span></a>
                    </li>
                    <li class="nav-item">
                        <a href="#caja_general" class="nav-link " data-toggle="tab" > <span>Movimientos</span></a>
                    </li>
                  
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                    <div  class="tab-pane active" id="balance_diario">
                        @include('caja_general.partials.balance')
                    </div>
                    <div id="caja_general" class="tab-pane fade">
                        @include('caja_general.partials.movimientos')
                        
                    </div>
                   
                </div>
            </div>
        </div>
    </div>

</div>
<!--End Row-->


<div class="modal fade nuevo_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
</div>
@endsection
@section('scripts')
<script src="{{ asset('js/cajaGeneral.js?v=' . $asset_v) }}"></script>
<script src="{{ asset('js/select.js?v=' . $asset_v) }}"></script>

@endsection
