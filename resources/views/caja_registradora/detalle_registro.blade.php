<div class="modal-dialog modal-lg" role="document">
  <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title">Detalles Caja Registradora  ({{\Carbon::createFromFormat('Y-m-d H:i:s', $close_time)->format('j M, Y h:i A')}}) </h3>
            <button type="button" class="close no-print" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>

         <div class="modal-body">
            <div class="row">
                <div class="col-sm-12">
                        <table class="table table-sm">
                            <tr>
                                <td>Apertura de Banca</td>
                                <td> <span class="display_currency"  data-currency_symbol="true">{{ $detalles->dinero_efectivo }}</span></td>
                            </tr>
                            <tr>
                                <td>Venta En Efectivo</td>
                                <td> <span class="display_currency"  data-currency_symbol="true">{{ $detalles->total_ticket }}</span></td>
                            </tr>
                            <tr>
                                <td>Venta Anticipado</td>
                                <td> <span class="display_currency"  data-currency_symbol="true">{{ $detalles->total_futuro }}</span></td>
                            </tr>
                                <tr>
                                <td>Venta Promocion</td>
                                <td> <span class="display_currency"  data-currency_symbol="true">{{ $detalles->total_promocion }}</span></td>
                            </tr>
                            </tr>
                                <tr>
                                <td>Ingreso de Dinero</td>
                                <td> <span class="display_currency"  data-currency_symbol="true">{{ $detalles->total_entrada }}</span></td>
                            </tr>
                            </tr>
                                <tr>
                                <td>Salida de Dinero</td>
                                <td> <span class="display_currency"  data-currency_symbol="true">{{ $detalles->total_salida }}</span></td>
                            </tr>
                            </tr>
                                <tr>
                                <td>Premios Pagados</td>
                                <td> <span class="display_currency"  data-currency_symbol="true">{{ $detalles->total_premios_pagados }}</span></td>
                            </tr>
                            <tr class="alert alert-success">
                                <td>Total Ventas</td>
                                <td> <span class="display_currency"  data-currency_symbol="true">{{ $detalles->total_futuro + $detalles->total_ticket }}</span></td>
                            </tr>
                            <tr class="alert alert-success">
                                <td>Total Neto</td>
                                <td><span class="display_currency"  data-currency_symbol="true">{{$detalles->total_ticket + $detalles->total_futuro - $detalles->total_salida - $detalles->total_premios_pagados  }}</span></td>
                            </tr>
                        </table>
                    </div>
                </div>


            {{-- <div class="row">
                <div class="col-xs-6">
                <b>Usuario:</b> <br>
                <b>Email:</b> <br>
                <b>Banca:</b> <br>
                </div>
            </div> --}}
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-primary no-print"
                aria-label="Print"
                onclick="$(this).closest('div.modal').printThis();">
                <i class="fa fa-print"> Imprimir </i>
            </button>

            <button type="button" class="btn btn-danger no-print"
                data-dismiss="modal">Cancelar
            </button>
        </div>
    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
