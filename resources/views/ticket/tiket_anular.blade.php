<div class="modal-dialog modal-xl" role="document">
        <div class="modal-content border-danger">

            <div class="modal-header bg-danger">
                <h3 class="modal-title text-white">Anular Ticket # {{ $ticket->invoice_no }}  Para el Sorteo del  ( {{ $ticket->invoice_date }} )</h3>
                <button type="button" class="close text-white no-print" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>

            <div class="modal-body">
             <div class="row">
            <div class="col-12 col-sm-12 col-md-5 col-lg-5 col-xl-5">
                @include('ticket.partials.ticket')
            </div>
            <div class="col-12 col-sm-12 col-md-7 col-lg-7 col-xl-7">

                {{-- RESULTADO --}}

                 {{-- NUMEROS GANADORES Y EL VALOR --}}
                <div class="card">
                    <div class="card-body ">
                        <h5 class="card-title border-success">Ingrese los detalles</h5>
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                            <div class="form-group">
                                <strong>Pin:</strong>
                                <input class="form-control" type="text" name="tic_pin" id="tic_pin" value=""   required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tia_detalle" class="col-sm-3 col-form-label">Motivo</label>
                            <div class="col-12 col-sm-9 col-md-12 col-lg-12 col-xl-12">
                                <textarea rows="4" class="form-control" name="tia_detalle" id="tia_detalle" required></textarea>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
            </div>

            <div class="modal-footer">
            <input type="hidden" id="tickets_id" name="tickets_id" value="{{ $tickets_id }}">
            
            <a href="#" data-href="{{action('Ticket\TicketController@getTicketAnular')}}" class="anularTicket btn btn-danger" ><i class="fa fa-times-circle-o" aria-hidden="true"></i> Anular</a>
            
            <button type="button" class="btn btn-info no-print"
                data-dismiss="modal"> Cerrar
            </button>
            </div>

        </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->



