@extends('layouts.app')
@section('title','Listado de Ticekts Vendidos')
    @section('content')
     <div class="row pt-2 pb-2 no-print">
        <div class="col-sm-9">
		    <h4 class="page-title">Tickets</h4>
	   </div>
        <div class="col-sm-3 no-print">
            <div class="btn-group float-sm-right">
                 @if((request()->session()->get('user.TipoUsuario') == 3) && (request()->session()->get('user.bancaBloqueo') == 0))
                 <a href="{{ route('pos.create') }}"  class="btn btn-primary waves-effect waves-primary"><i class="fa fa-ticket mr-1"></i> Crear Ticket</a>
                @endif
            </div>
        </div>
     </div>
     {{-- @dump($tickets) --}}
     @if((request()->session()->get('user.TipoUsuario') == 2) || (request()->session()->get('user.useSupervisor') == 1))
        @include('reportes.partials.opcionesAdmin')
        @elseif((request()->session()->get('user.TipoUsuario') == 3))
            @include('reportes.partials.opcionesBanca')
        @endif
        <div class="row no-print">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-sm"  id="reporte_tickets">
                                    <thead>
                                        <tr>
                                            <th>Fecha</th>
                                            <th>Ticket</th>
                                            <th>Loteria</th>
                                            <th>Total de Numeros</th>
                                            <th>Total Apostado</th>
                                            <th>Estado Ticket</th>
                                            <th>Opciones</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                    </div>
                </div>
            </div>
      </div><!--End Row-->
<!-- /.content -->
<div class="modal fade view_register no-print" tabindex="-1" role="dialog"
    aria-labelledby="gridSystemModalLabel">
</div>
    <div class="modal fade ticket_modal no-print" tabindex="-1" role="dialog"
        aria-labelledby="gridSystemModalLabel">
    </div>

    <div class="modal fade pagar_premio_modal no-print" tabindex="-1" role="dialog"
        aria-labelledby="gridSystemModalLabel">
    </div>
<div class="modal fade anular_modal no-print" tabindex="-1" role="dialog"
        aria-labelledby="gridSystemModalLabel">
    </div>
   @endsection
@section('scripts')
        <script src="{{ asset('js/reportes/tickets.js?v=' . $asset_v) }}"></script>
        <script src="{{ asset('js/ticket/ticket.js?v=' . $asset_v) }}"></script>
        <script src="{{ asset('js/select.js?v=' . $asset_v) }}"></script>
 @endsection
