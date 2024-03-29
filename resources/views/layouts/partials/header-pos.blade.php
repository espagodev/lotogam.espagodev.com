@inject('request', 'Illuminate\Http\Request')

<div class="no-print pos-header">
    <div class="row">
            <div class="col-12 col-sm-12 col-md-6 col-xs-12">
                <p>
               <strong>POS Loterias ({{ Session::get('user.surname') }})</strong>
                {{ @format_datetime('now') }}</p>
                
            </div>
            <div class="col-12 col-sm-12 col-md-6 col-xs-12">
                 <a href="{{ asset('reportes/reporte-ventas') }}" title="" data-toggle="tooltip" data-placement="bottom" class="btn btn-info btn-flat btn-sm  m-5 pull-right">
                    <strong><i class="fa fa-file-text-o "></i></strong>
                </a>

                <button type="button" id="close_register" title="Cerrar Caja Registradora" class="btn btn-danger btn-flat m-6 btn-sm m-5 btn-modal pull-right" data-container=".close_register_modal"
                    data-href="{{ action('CajaRegistradoraController@getCerrarRegistro')}}">
                        <strong><i class="fa fa-window-close fa-lg"></i></strong>
                </button>

                <button type="button" id="register_details" title="Caja Registradora Detalles" class="btn btn-success btn-flat m-6 btn-sm m-5 btn-modal pull-right" data-container=".register_details_modal"
                    data-href="{{ action('CajaRegistradoraController@getDetalleRegistro')}}">
                        <strong><i class="fa fa-briefcase fa-lg" aria-hidden="true"></i></strong>
                </button> 

                <button type="button" title="full_screen" class="btn btn-primary btn-flat hidden-xs  btn-sm m-5 pull-right" id="full_screen">
                    <strong><i class="fa fa-window-maximize fa-lg"></i></strong>
                </button>
                <button type="button" class="btn btn-primary btn-flat btn-sm m-5 pull-right " data-toggle="modal" data-target="#recent_transactions_modal" id="recent-transactions"> <i class="fa fa-ticket"></i> Recientes</button>
                
                <p class="mb-0 ">Saldo Disponible <span  class="progres-estado  float-right"></p>
                <div class="progress my-1" style="height:11px;">
                    <div class="progress-bar" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" data-progress="0" style="width: 0%;">
                        0%
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>



