@extends('layouts.app')
@section('title','Reporte de Ticekts Premiados')
    @section('content')
   @if((request()->session()->get('user.TipoUsuario') == 2) || (request()->session()->get('user.useSupervisor') == 1))
        @include('reportes.partials.opcionesAdmin')
        @elseif((request()->session()->get('user.TipoUsuario') == 3))
            @include('reportes.partials.opcionesBanca')
        @endif
    <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-sm"  id="reporte_premiados">
                                    <thead>
                                        <tr>
                                            <th>Ticket</th>
                                            <th>Fecha</th>
                                            <th>Loteria</th>
                                            <th>Apostado</th>
                                            <th>Premio</th>
                                            <th>Estado</th>
                                            <th>Pagado EL</th>
                                            <th>Opciones</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
            </div>

    </div>

    <div class="modal fade view_register" tabindex="-1" role="dialog"
        aria-labelledby="gridSystemModalLabel">
    </div>

    <div class="modal fade ticket_modal" tabindex="-1" role="dialog"
        aria-labelledby="gridSystemModalLabel">
    </div>

    <div class="modal fade pagar_premio_modal" tabindex="-1" role="dialog"
        aria-labelledby="gridSystemModalLabel">
    </div>
    @endsection
@section('scripts')
	<script src="{{ asset('js/reporte_premiados.js?v=' . $asset_v) }}"></script>
    <script src="{{ asset('js/ticket/ticket.js?v=' . $asset_v) }}"></script>
    <script src="{{ asset('js/select.js?v=' . $asset_v) }}"></script>
@endsection
