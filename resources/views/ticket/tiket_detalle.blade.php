<div class="modal-dialog" role="document">
  <div class="modal-content border-info">

    <div class="modal-header bg-info">
         <h3 class="modal-title text-white">Ticket # {{ $receipt_details->invoice_no }}  Para el Sorteo del  ( {{ $receipt_details->invoice_date }} )</h3>
         <button type="button" class="close text-white no-print" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    </div>

    <div class="modal-body">
        @include('ticket.partials.ticket')
    </div>

    <div class="modal-footer">
     <a href="#" data-href="{{route('pos.printTicket', [$tickets_id])}}" class="print-invoice btn btn-primary" ><i class="fa fa-print" aria-hidden="true"></i>Imprimir</a>

      <button type="button" class="btn btn-info no-print"
        data-dismiss="modal"> Cerrar
      </button>
    </div>

  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->


