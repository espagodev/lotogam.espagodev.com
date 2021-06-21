<div class="modal-dialog modal-xl" role="document">
  <div class="modal-content border-success">

    <div class="modal-header bg-success">
         <h3 class="modal-title text-white">Ticket # {{ $receipt_details->invoice_no }}  Para el Sorteo del  ( {{ $receipt_details->invoice_date }} )</h3>
         <button type="button" class="close text-white no-print" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    </div>

    <div class="modal-body">

        <div class="row">
            <div class="col-5 col-sm-5 col-md-5 col-lg-5 col-xl-5">
                @include('ticket.partials.ticket')
            </div>
            <div class="col-7 col-sm-7 col-md-7 col-lg-7 col-xl-7">

                {{-- RESULTADO --}}
                <div class="card">
                    <div class="card-body ">
                        <h5 class="card-title border-success">Resultados Para {{ $ticket[0]->lot_nombre }}</h5>

                              <h3>  <span class='badge badge-pill badge-primary m-1'> {{  $ticket[0]->res_premio1}}</span>
                                <span class='badge badge-pill badge-secondary m-1'> {{  $ticket[0]->res_premio2}}</span>
                                <span class='badge badge-pill badge-success m-1'> {{  $ticket[0]->res_premio3}}</span></h3>
                    </div>
                </div>
                {{-- @dump($jugadas) --}}
                 {{-- NUMEROS GANADORES Y EL VALOR --}}
                <div class="card">
                    <div class="card-body ">
                        <h5 class="card-title border-success">Numero Premiados</h5>
                            <div class="table-responsive">
                                <table class="table table-sm">
                                    <thead>
                                    <tr>
                                        <th>Numero</th>
                                        <th>Apuesta</th>
                                        <th>Ganado</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                         @foreach ($jugadas as  $jugada)
                                           <tr>
                                                <td> {{  $jugada->tid_apuesta}} </td>
                                                <td><span class="display_currency" data-orig-value='{{  $jugada->tid_valor}}' data-currency_symbol=true>{{  $jugada->tid_valor}}</span> </td>
                                                <td><span class="display_currency" data-orig-value='{{  $jugada->tid_ganado}}' data-currency_symbol=true>{{  $jugada->tid_ganado}} </span></td>

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                        {{-- Total a Pagar --}}

                        <div class="card">
                            <div class="card-body ">
                                <h5 class="card-title">Total a Pagar:</h5>
                                    @php
                                        $total = 0;
                                    @endphp
                                @foreach ($jugadas as  $jugada)
                                    @php
                                     $total = $total + $jugada->tid_ganado;
                                    @endphp
                                @endforeach
                                <h3><span class="display_currency badge badge-pill badge-success m-1" data-orig-value='{{ $total }}' data-currency_symbol=true>{{ $total }}</span></h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal-footer">
     <button type="button" class="btn btn-success btn-xs  pagar_premio" data-href="{{action('Ticket\TicketController@getPagarTicketPremiado', [$ticket[0]->id]) }}"><i class="fa fa-money"></i> Realizar Pago</button>
      <button type="button" class="btn btn-info no-print"
        data-dismiss="modal"> Cerrar
      </button>
    </div>

  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->

