<div class="modal-dialog modal-xl" role="document">
      {{-- <form method="post" action="{{ route('resultados.store')}}" > --}}
        <div class="modal-content border-warning">

            <div class="modal-header bg-warning">
                <h3 class="modal-title text-white">Pagar Ticket # {{ $ticket[0]->tic_ticket }}   Sorteado del  ( {{ $ticket[0]->tic_fecha_sorteo }} )</h3>
                <button type="button" class="close text-white no-print" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>

            <div class="modal-body">
            <div class="row">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                        <div class="card">
                                <div class="card-body ">
                                    <div class="row">
                                        <div class="col-4 col-sm-4 col-md-4 col-lg-4 col-xl-4">
                                            <div class="form-group">
                                                <strong>Numero de Ticket:</strong>
                                            <input class="form-control" type="text" name="tic_ticket" id="tic_ticket" value="{{ $ticket[0]->tic_ticket }}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-4 col-sm-4 col-md-4 col-lg-4 col-xl-4">
                                            <div class="form-group">
                                                <strong>Monto Premio:</strong>
                                                <input class="form-control " type="text" name="tic_ganado" id="tic_ganado"  value="{{ $ticket[0]->tic_ganado }}"  readonly required >
                                            </div>
                                        </div>

                                        <div class="col-4 col-sm-4 col-md-4 col-lg-4 col-xl-4">
                                            <div class="form-group">
                                                <strong>Pin:</strong>
                                                <input class="form-control" type="text" name="tic_pin" id="tic_pin" value=""   required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>


                {{-- <div class="row">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                        <div class="card">
                            <div class="card-body ">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-4 col-md-4">
                                        <div class="form-group">
                                            <strong>Monto a Pagar:</strong>
                                            <input class="form-control" type="text" name="tip_valor_pagado" id="tip_valor_pagado"  value=""  >
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-4 col-md-4">
                                        <div class="form-group">
                                            <strong>Cantidad Pendiente:</strong>
                                            <input class="form-control" type="text" name="tip_valor_pendiente" id="tip_valor_pendiente" value=""  readonly  >
                                        </div>
                                    </div>
                                        <div class="col-xs-12 col-sm-4 col-md-4">
                                        <div class="form-group">
                                            <strong>Forma de Pago:</strong>
                                            <select class="form-control" name="medios_pagos_id" id="medios_pagos_id" required>
                                                <option value="">Seleccione</option>
                                                    @foreach($mediopagos as $mediopago)
                                                    <option value="{{ $mediopago->identificador }}" >{{ $mediopago->medioPago }}</option>
                                                    @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>

            <div class="modal-footer">
            <input type="hidden" id="tickets_id" name="tickets_id" value="{{ $tickets_id }}">
            <a href="#" data-href="{{action('Ticket\TicketController@getPagarPremio')}}" class="pagarPremio btn btn-success" ><i class="fa fa-money" aria-hidden="true"></i> Pagar</a>

            <button type="button" class="btn btn-info no-print"
                data-dismiss="modal"> Cerrar
            </button>
            </div>

        </div><!-- /.modal-content -->
    {{-- </form> --}}
</div><!-- /.modal-dialog -->

