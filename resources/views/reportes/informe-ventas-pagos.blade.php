@extends('layouts.app')
@section('title','Informe de Ventas y Pagos')
    @section('content')
        <div class="row pt-2 pb-2">
            <div class="col-sm-9">
                <h4 class="page-title">Informe de Ventas y Pagos para el intervalo de fechas seleccionado</h4>
        </div>
     </div>
        @include('reportes.partials.opcionesInforme')


        <div class="row">
            <div class="col-lg-6">
                    <div class="card">
                            <div class="card-header d-flex align-items-left">
                                <div class="d-flex justify-content-left col">
                                    <div class="h4 m-0 text-left">Ventas</div>
                                </div>
                            </div>
                        <div class="card-body">
                            <table class="table table-bordered table-striped"  id="informe_ventas">
                                <tr>
                                    <th>Venta Total:</th>
                                    <td>
                                        <span class="venta_total">
                                            <i class="fas fa-sync fa-spin fa-fw"></i>
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Venta Promocion:</th>
                                    <td>
                                        <span class="venta_promocion">
                                            <i class="fas fa-sync fa-spin fa-fw"></i>
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Venta a Futuro:</th>
                                    <td>
                                        <span class="venta_futuro">
                                            <i class="fas fa-sync fa-spin fa-fw"></i>
                                        </span>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
            </div>
             <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header d-flex align-items-left">
                                <div class="d-flex justify-content-left col">
                                    <div class="h4 m-0 text-left">Pagos</div>
                                </div>
                            </div>
                        <div class="card-body">
                            <table class="table table-bordered table-striped"  id="informe_pagos">

                                 <tr>
                                    <th>Pendiente de Pago:</th>
                                    <td>
                                        <span class="pago_pendiente">
                                            <i class="fas fa-sync fa-spin fa-fw"></i>
                                        </span>
                                    </td>
                                </tr>
                                 <tr>
                                    <th>Pendiente de Pago Promocion:</th>
                                    <td>
                                        <span class="pago_pendiente_promo">
                                            <i class="fas fa-sync fa-spin fa-fw"></i>
                                        </span>
                                    </td>
                                </tr>
                                 <tr>
                                    <th>Premios Pagados Total:</th>
                                    <td>
                                        <span class="pago_total">
                                            <i class="fas fa-sync fa-spin fa-fw"></i>
                                        </span>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
            </div>
        </div>
    @endsection

@section('scripts')
    <script src="{{ asset('js/informeVentasPagos.js?v=' . $asset_v) }}"></script>
@endsection
