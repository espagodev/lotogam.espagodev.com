@extends('layouts.app')
@section('title','Reporte de Tickets')
    @section('content')
   @if((request()->session()->get('user.TipoUsuario') == 2))
        @include('reportes.partials.opcionesAdmin')
        @elseif((request()->session()->get('user.TipoUsuario') == 3))
            @include('reportes.partials.opcionesBanca')
        @endif
    <div class="row">
            <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-bordered table-striped"  id="reporte_tickets">
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
                        </div>
                    </div>
            </div>
             {{-- <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-sm table-striped  fixed_header">
                                <thead>
                                    <tr>
                                        <th class="text-center">Numeros</th>
                                        <th class="text-center">Apuesta</th>
                                        <th class="text-center">Gano</th>
                                    </tr>
                                </thead>
                                 <tbody class="detalle">
                                </tbody>
                            </table>
                        </div>
                    </div>
            </div> --}}
    </div>
    <!-- /.content -->
<div class="modal fade view_register" tabindex="-1" role="dialog"
    aria-labelledby="gridSystemModalLabel">
</div>

    <div class="modal fade ticket_modal" tabindex="-1" role="dialog"
        aria-labelledby="gridSystemModalLabel">
    </div>

    <div class="modal fade pagar_premio_modal" tabindex="-1" role="dialog"
        aria-labelledby="gridSystemModalLabel">
    </div>
    <div class="modal fade anular_modal" tabindex="-1" role="dialog"
        aria-labelledby="gridSystemModalLabel">
    </div>
    @endsection
@section('scripts')
	<script src="{{ asset('js/reporte_tickets.js?v=' . $asset_v) }}"></script>
    <script src="{{ asset('js/ticket/ticket.js?v=' . $asset_v) }}"></script>
@endsection
