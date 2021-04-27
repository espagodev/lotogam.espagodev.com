<div class="modal-dialog" role="document">
  <div class="modal-content border-secondary">

    <div class="modal-header bg-secondary">
         <h3 class="modal-title text-white">Ticket # {{ $receipt_details->invoice_no }}  Para el Sorteo del  ( {{ $receipt_details->invoice_date }} )</h3>
         <button type="button" class="close text-white no-print" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    </div>

    <div class="modal-body">
        @include('ticket.partials.ticket')
    </div>

    <div class="modal-footer">
     <a href="{{action('Temp\ApuestaDetalleTempController@duplicarTicket', [$tickets_id])}}" class=" btn btn-primary"><i class="fa fa-clone" aria-hidden="true"></i> Duplicar Ticket</a>

      <button type="button" class="btn btn-secondary no-print"
        data-dismiss="modal"> Cerrar
      </button>
    </div>

  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->


