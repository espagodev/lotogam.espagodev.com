@extends('layouts.app')
@section('title','Reporte de Ventas')
    @section('content')
   @include('reportes.partials.ventas')
    <div class="row">
            <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-bordered table-striped"  id="reporte_ventas">
                                <thead>
                                    <tr>
                                        <th>Loteria</th>
                                        <th>Venta Total</th>
                                        <th>Comisiòn Total</th>
                                        <th>Total Premios</th>
                                        <th>Ganancia</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr class="bg-gray font-17 footer-total text-center">
                                        <td><strong>Total:</strong></td>
                                        <td><span class="display_currency" id="footer_total_venta" data-currency_symbol ="true"></span></td>
                                        <td><span class="display_currency" id="footer_total_comision" data-currency_symbol ="true"></span></td>
                                        <td><span class="display_currency" id="footer_total_premios" data-currency_symbol ="true"></span></td>
                                        <td><span class="display_currency" id="footer_total_ganancia" data-currency_symbol ="true"></span></td>
                                    </tr>
                                </tfoot>
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
                                        <th class="text-center">Numeros</th>
                                        <th class="text-center">Apuesta</th>
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
    <script src="{{ asset('js/reportes.js?v=' . $asset_v) }}"></script>
@endsection
