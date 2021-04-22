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

<link href="{{ asset('css/ticket.css')}}" rel="stylesheet" />

<style lang="css">
    .lista-scroll {
    display: block;
    width: 100%;
    overflow: auto;
    height: 450px;
    }
    </style>

<style type="text/css">

    .f-right {
    float: right;
    }

    .f-left {
    float: left;
    }

    .text-box {
	width: 100%;
	height: auto;
    }

    .textbox-info {
        clear: both;
    }
    .textbox-info p {
        margin-bottom: 0px
    }

    .centered {
    text-align: center;
    align-content: center;
    }

    .center-block {
    display: block;
    margin-right: auto;
    margin-left: auto;
    }

    .text-left {
    text-align: left;
    }
    .text-right {
    text-align: right;
    }

    .flex-box-encabezado {
    width: 80%;
    display: flex;
    justify-content: space-between;
    }

    .flex-box {
    width: 50%;
    display: flex;
    justify-content: space-between;
    }

    .flex-box p {
        width: auto;
        margin-bottom: 0px;
        justify-content: space-between;
    }
</style>
