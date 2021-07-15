<div class="modal-dialog modal-lg" role="document">
     <form method="post" action="{{ action("CajaRegistradoraController@postCerrarRegistro") }}">
        @csrf
         {{-- <input type="hidden" name="users_id" id="users_id"  value=""> --}}
        <div class="modal-content">

                <div class="modal-header">
                    <h3 class="modal-title">Detalles Caja Registradora  ({{\Carbon::createFromFormat('Y-m-d H:i:s', $close_time)->format('j M, Y h:i A')}})</h3>
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

                        <div class="row">
                            <div class="col-sm-4">
                            <div class="form-group">
                                <strong>Efectivo Total:</strong>
                                <input type="text" class="form-control{{ $errors->has('caj_monto_cierre') ? ' is-invalid' : '' }}"  id="caj_monto_cierre" name="caj_monto_cierre" value="{{ @num_format($detalles->total_ticket + $detalles->total_futuro - $detalles->total_salida - $detalles->total_premios_pagados ) }}" >
                            </div>
                            </div>
                            <div class="col-sm-4">
                            <div class="form-group">

                            </div>
                            </div>
                            <div class="col-sm-4">
                            <div class="form-group">

                            </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="caj_nota_cierre" class="col-sm-3 col-form-label">Nota de Cierre</label>
                                    <textarea rows="4" class="form-control" name="caj_nota_cierre" id="caj_nota_cierre" ></textarea>
                                </div>
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
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Cerrar Registro</button>
                </div>
            </div><!-- /.modal-content -->
     </form>
</div><!-- /.modal-dialog -->
