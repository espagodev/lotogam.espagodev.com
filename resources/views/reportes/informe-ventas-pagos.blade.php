@extends('layouts.app')
@section('title','Informe de Ventas y Pagos')
    @section('content')
        <div class="row pt-2 pb-2">
            <div class="col-sm-9">
                <h4 class="page-title">Informe de Ventas y Pagos para el intervalo de fechas seleccionado</h4>
            </div>
        </div>
        @include('reportes.partials.opcionesInforme')

     <section class="content">
          <div class="print_section"><h2>({{ Session::get('user.surname') }}) - Informe de Ventas y Pagos</h2></div>
        <div class="row">
            <div class="col-lg-4">
                    <div class="card">
                            <div class="card-header d-flex align-items-left">
                                <div class="d-flex justify-content-left col">
                                    <div class="h4 m-0 text-left">Ventas</div>
                                </div>
                            </div>
                        <div class="card-body">
                            <table class="table table-bordered table-striped"  id="informe_ventas">
                                <tr>
                                    <th>Total Venta:</th>
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
                                 <tr>
                                    <th>Total Comision:</th>
                                    <td>
                                        <span class="venta_comison">
                                            <i class="fas fa-sync fa-spin fa-fw"></i>
                                        </span>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
            </div>
             <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header d-flex align-items-left">
                                <div class="d-flex justify-content-left col">
                                    <div class="h4 m-0 text-left">Pagos</div>
                                </div>
                            </div>
                        <div class="card-body">
                            <table class="table table-bordered table-striped"  id="informe_pagos">

                                 <tr>
                                    <th>ToTal Premios:</th>
                                    <td>
                                        <span class="total_premios">
                                            <i class="fas fa-sync fa-spin fa-fw"></i>
                                        </span>
                                    </td>
                                </tr>
                                 <tr>
                                    <th>ToTal Premios Promocion:</th>
                                    <td>
                                        <span class="total_premios_promo">
                                            <i class="fas fa-sync fa-spin fa-fw"></i>
                                        </span>
                                    </td>
                                </tr>
                                 <tr>
                                    <th>Total Premios Pagados:</th>
                                    <td>
                                        <span class="total_pagado">
                                            <i class="fas fa-sync fa-spin fa-fw"></i>
                                        </span>
                                    </td>
                                </tr>
                                  <tr>
                                    <th>Total Premios por Pagar:</th>
                                    <td>
                                        <span class="total_pendiente_pago">
                                            <i class="fas fa-sync fa-spin fa-fw"></i>
                                        </span>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
            </div>
              <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header d-flex align-items-left">
                                <div class="d-flex justify-content-left col">
                                    <div class="h4 m-0 text-left">Otros Movimientos</div>
                                </div>
                            </div>
                        <div class="card-body">
                            <table class="table table-bordered table-striped table-condensed"  id="informe_pagos">
                                <tr>
                                    <th class="text-info">Balance Inical:</th>
                                    <td>
                                        <span class="balance_inicial  text-info">
                                            <i class="fas fa-sync fa-spin fa-fw"></i>
                                        </span>
                                    </td>
                                </tr>
                                 <tr>
                                    <th>Ingresos a Banca:</th>
                                    <td>
                                        <span class="total_entrada">
                                            <i class="fas fa-sync fa-spin fa-fw"></i>
                                        </span>
                                    </td>
                                </tr>
                                 <tr>
                                    <th>Salidas de Banca:</th>
                                    <td>
                                        <span class="total_salida">
                                            <i class="fas fa-sync fa-spin fa-fw"></i>
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Cupo Adicional:</th>
                                    <td>
                                        <span class="total_cupo">
                                            <i class="fas fa-sync fa-spin fa-fw"></i>
                                        </span>
                                    </td>
                                </tr>
                                 <tr>
                                    <th>Gastos Banca:</th>
                                    <td>
                                        <span class="">
                                            <i class="fas fa-sync fa-spin fa-fw"></i>
                                        </span>
                                    </td>
                                </tr>

                            </table>
                        </div>
                    </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header d-flex align-items-left">
                        <div class="d-flex justify-content-left col">
                            <div class="h5 m-0 text-left">Total Neto (total venta + venta futuro - total premios - comision)</div>
                        </div>
                    </div>
                    <div class="card-body">
                        <h3 class="text-muted">
                            Neto Total:
                            <span class="neto_total text-info">
                                <i class="fas fa-sync fa-spin fa-fw"></i>
                            </span>
                        </h3>

                        <h3 class="text-muted">
                            Saldo Final:
                            <span class="neto_faltante text-danger">
                                <i class="fas fa-sync fa-spin fa-fw"></i>
                            </span>
                        </h3>
                    </div>
                </div>
            </div>
         </div>
        <div class="row no-print">
            <div class="col-sm-12">
                <button type="button" class="btn btn-primary pull-right"
                aria-label="Print" onclick="window.print();"
                ><i class="fa fa-print"></i> Imprimir</button>
            </div>
        </div>
     </section>
    @endsection

@section('scripts')
    <script src="{{ asset('js/informeVentasPagos.js?v=' . $asset_v) }}"></script>
@endsection
