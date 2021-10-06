@extends('layouts.app')
@section('title','Reporte de Tickets')
    @section('content')
   @if((request()->session()->get('user.TipoUsuario') == 2) || (request()->session()->get('user.useSupervisor') == 1))
        @include('reportes.partials.opcionesAdmin')
        @elseif((request()->session()->get('user.TipoUsuario') == 3))
            @include('reportes.partials.opcionesBanca')
        @endif
    <div class="row no-print">
            <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                             {{-- <div class="table-responsive"> --}}
                                <table class="table table-bordered table-striped  table-sm no-print"  id="reporte_tickets">
                                    <thead>
                                        <tr>
                                            <th>Loteria</th>
                                            <th>Ticket</th>
                                            <th>Fecha</th>
                                            <th>Apostado</th>
                                            <th>Premio</th>
                                            <th>Estado</th>
                                            <th>Opciones</th>

                                        </tr>
                                    </thead>
                                </table>
                             {{-- </div> --}}
                        </div>
                    </div>
            </div>

    </div>
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
	<script src="{{ asset('js/reporte_tickets.js?v=' . $asset_v) }}"></script>
    <script src="{{ asset('js/ticket/ticket.js?v=' . $asset_v) }}"></script>
    <script src="{{ asset('js/select.js?v=' . $asset_v) }}"></script>
@endsection
