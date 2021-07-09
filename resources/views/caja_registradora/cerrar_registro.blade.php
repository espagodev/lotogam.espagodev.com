<div class="modal-dialog modal-lg" role="document">
     <form method="post" action="{{ action("CajaRegistradoraController@postCerrarRegistro") }}" >
        <div class="modal-content">

                <div class="modal-header">
                    <h3 class="modal-title">Detalles Caja Registradora  ({{\Carbon::createFromFormat('Y-m-d H:i:s', $close_time)->format('j M, Y h:i A')}})</h3>
                    <button type="button" class="close no-print" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                        <table class="table table-condensed">
                                <tr>
                                    <td>Dinero En Efectivo</td>
                                    <td> <span class="display_currency" data-currency_symbol="true">{{ $detalles->cash_in_hand }}</span></td>
                                </tr>
                                <tr>
                                    <td>Pago En Efectivo</td>
                                    <td> <span class="display_currency" data-currency_symbol="true">{{ $detalles->total_cash }}</span></td>
                                </tr>
                                <tr>
                                    <td>Pago Anticipado</td>
                                    <td> <span class="display_currency" data-currency_symbol="true">{{ $detalles->total_cash }}</span></td>
                                </tr>
                                <tr class="success">
                                    <td>Pago Total</td>
                                    <td> <span class="display_currency" data-currency_symbol="true">{{ $detalles->cash_in_hand +$detalles->total_cash }}</span></td>
                                </tr>
                                <tr class="success">
                                    <td>Ventas a Credito</td>
                                    <td> <span class="display_currency" data-currency_symbol="true">{{ $detalles->total_cash }}</span></td>
                                </tr>
                                <tr class="success">
                                    <td>Ventas Totales</td>
                                    <td> <span class="display_currency" data-currency_symbol="true">{{ $detalles->total_cash }}</span></td>
                                </tr>
                            </table>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-12">
                            <hr>
                            <h4>Detalle de los Tickets Vendidos</h4>
                            <table class="table">
                            <tr>
                                <th>#</th>
                                <th>Estados</th>
                                <th>Cantidad</th>
                                <th>Monto Total</th>
                            </tr>
                            @php
                                $total_amount = 0;
                                $total_quantity = 0;
                            @endphp
                            {{-- @foreach($details['product_details'] as $detail)
                                <tr>
                                <td>
                                    {{$loop->iteration}}.
                                </td>
                                <td>
                                    {{$detail->brand_name}}
                                </td>
                                <td>
                                    {{$detail->total_quantity}}
                                    @php
                                    $total_quantity += $detail->total_quantity;
                                    @endphp
                                </td>
                                <td>
                                    <span class="display_currency" data-currency_symbol="true">
                                    {{$detail->total_amount}}
                                    </span>
                                    @php
                                    $total_amount += $detail->total_amount;
                                    @endphp
                                </td>
                                </tr>
                            @endforeach


                            @php
                                $total_amount += ($details['transaction_details']->total_tax - $details['transaction_details']->total_discount);
                            @endphp --}}

                            <!-- Final details -->
                            <tr class="success">
                                <th>#</th>
                                <th></th>
                                <th>{{$total_quantity}}</th>
                                <th>
                                Gran Total:
                                <span class="display_currency" data-currency_symbol="true">
                                    {{-- {{$total_amount}} --}}
                                </span>
                                </th>
                            </tr>

                            </table>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-6">
                        <b>Usuario:</b> <br>
                        <b>Email:</b> <br>
                        <b>Banca:</b> <br>
                        </div>
                        {{-- @if(!empty($register_details->closing_note))
                        <div class="col-xs-6">
                            <strong>@lang('cash_register.closing_note'):</strong><br>
                            {{$register_details->closing_note}}
                        </div>
                        @endif --}}
                    </div>


                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Cerrar Registro</button>
                </div>
            </div><!-- /.modal-content -->
     </form>
</div><!-- /.modal-dialog -->
