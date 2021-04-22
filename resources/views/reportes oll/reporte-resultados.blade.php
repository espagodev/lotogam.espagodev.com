@extends('layouts.app')
@section('title', 'Reporte de Resultados')

    @section('content')
   @include('reportes.partials.resultados')
    <div class="row">
            <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-bordered table-striped"  id="reporte_resultados">
                                <thead>
                                    <tr>
                                        <th>Loteria</th>
                                        <th>Fecha</th>
                                        <th>No 1</th>
                                        <th>No 2</th>
                                        <th>No 3</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
            </div>
             <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-sm table-striped  fixed_header"> 
                                <thead>
                                    <tr>
                                        <th class="text-center">Ticket</th>
                                        <th class="text-center">Jugada</th>
                                        <th class="text-center">Premio</th>
                                    </tr>
                                </thead>
                                 <tbody class="detalle">
                                </tbody>
                            </table>
                        </div>
                    </div>
            </div>
    </div>
    @endsection
@section('scripts')
	<script src="{{ asset('js/reporte_resultados.js?v=' . $asset_v) }}"></script>
@endsection
