@inject('request', 'Illuminate\Http\Request')

<div class="no-print pos-header">
    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-xs-12">
            <div class="row">
                <div class="col-12 col-sm-6 col-md-6 col-xs-12"><h5>POS Loterias ({{ Session::get('user.surname') }})</h5></div>

                <div class="col-12 col-sm-6 col-md-6 col-xs-12">
                    <div class="row">
                            <div class="col-5 col-sm-5 col-md-5  col-xs-12 ">
                            <button type="button" class="btn btn-sm  btn-primary btn-flat" data-toggle="modal" data-target="#recent_transactions_modal" id="recent-transactions"> <i class="fa fa-ticket"></i> Recientes</button>
                        </div>
                        <div class="col-2 col-sm-2 col-md-2  col-xs-12 ">
                            <a href="{{ asset('reportes/reporte-ventas') }}" title="" data-toggle="tooltip" data-placement="bottom" class="btn btn-info btn-flat btn-sm  pull-right">
                                <strong><i class="fa fa-file-text-o "></i></strong>
                            </a>
                        </div>
                        <div class="col-5 col-sm-5 col-md-5  col-xs-12">
                            <div class="pull-right mt-15 "><strong>{{ @format_datetime('now') }}</strong></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
