@extends('layouts.app')
@section('title','Reporte de Ticekts Premiados')
    @section('content')
   @include('reportes.partials.premiados')
    <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="card">
                        <div class="card-body">

                                <table class="table table-bordered table-striped"  id="reporte_premiados">
                                    <thead>
                                        <tr>
                                            <th>Ticket</th>
                                            <th>Fecha</th>
                                            <th>Loteria</th>
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
             {{-- <div class="col-3 col-sm-3 col-md-3 col-lg-3 col-xl-3">
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
@endsection
