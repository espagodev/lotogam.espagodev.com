@extends('layouts.app')
@section('title', 'Registro de Informes')

    @section('content')
        @include('reportes.partials.opcionesRegistro')

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                             <div class="table-responsive">
                                <table class="table table-bordered table-striped table-sm"  id="reporte_registro">
                                    <thead>
                                        <tr>
                                            <th>Hora Apertura</th>
                                            <th>Hora Cierre</th>
                                            <th>Banca</th>
                                            <th>Usuario</th>
                                            <th>Efectivo Total</th>
                                            <th>Estado</th>
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
    @endsection
@section('scripts')
	<script src="{{ asset('js/reporte_registro.js?v=' . $asset_v) }}"></script>
    <script src="{{ asset('js/select.js?v=' . $asset_v) }}"></script>
@endsection
