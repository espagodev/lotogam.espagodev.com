@inject('request', 'Illuminate\Http\Request')

<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 no-print pos-header">
  <input type="hidden" id="pos_redirect_url" value="{{action('PosController@create')}}">
  <div class="row">
    <div class="col-7 col-sm-7 col-md-7 col-lg-7 col-xl-7">
        <h4>POS Loterias <i class="fa fa-keyboard-o hover-q text-muted"></i></h4>
    </div>
    <div class="col-2 col-sm-2 col-md-2 col-lg-2 col-xl-2">
         <button type="button" class="btn btn-sm  btn-primary btn-flat pull-right" data-toggle="modal" data-target="#recent_transactions_modal" id="recent-transactions"> <i class="fa fa-clock-o"></i> Tickets Recientes</button>
    </div>
    <div class="col-1 col-sm-1 col-md-1 col-lg-1 col-xl-1">
      <a href="{{ action('PosController@index')}}" title="" data-toggle="tooltip" data-placement="bottom" class="btn btn-info btn-flat  btn-sm  pull-right">
        <strong><i class="fa fa-backward fa-lg"></i></strong>
      </a>
    </div>
    <div class="col-2 col-sm-2 col-md-2 col-lg-2 col-xl-2">
      <div class="pull-right mt-15 hidden-xs"><strong>{{ @format_datetime('now') }}</strong></div>
    </div>

  </div>
</div>
