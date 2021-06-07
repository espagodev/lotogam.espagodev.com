@inject('request', 'Illuminate\Http\Request')

<div class="no-print pos-header">
  <div class="row">
    <div class="col-5 col-sm-6 col-md-5  col-xs-12">
        <h5>POS Loterias <i class="fa fa-keyboard-o hover-q text-muted"></i></h5>
    </div>
    <div class="col-3 col-sm-2 col-md-3  col-xs-12">
         <button type="button" class="btn btn-sm  btn-primary btn-flat pull-right" data-toggle="modal" data-target="#recent_transactions_modal" id="recent-transactions"> <i class="fa fa-clock-o"></i> Tickets Recientes</button>
    </div>
    <div class="col-2 col-sm-1 col-md-1  col-xs-12">
      <a href="{{ action('PosController@index')}}" title="" data-toggle="tooltip" data-placement="bottom" class="btn btn-info btn-flat  btn-sm  pull-right">
        <strong><i class="fa fa-backward fa-lg"></i></strong>
      </a>
    </div>
    <div class="col-2 col-sm-3 col-md-3  col-xs-12">
      <div class="pull-right mt-15 "><strong>{{ @format_datetime('now') }}</strong></div>
    </div>
  </div>
</div>
