<div class="card">
    <div class="card-body">
        <div class="row">
            @if((request()->session()->get('user.TipoUsuario') == 2))
                <div class="col-xs-12 col-sm-12 col-md-4">
                        @include('reportes.partials.__bancas')
                </div>
                 <div class="col-xs-12 col-sm-12 col-md-4">
                        @include('reportes.partials.__usuarios')
                </div>
            @endif
            <div class="col-xs-12 col-sm-12 col-md-4">
                @include('reportes.partials.__fechas')
            </div>
            <div class="col-xs-12 col-sm-12 col-md-4">
                <a href="#" type="button" class="btn btn-info print-venta" data-href="{{action('ReportesController@getVentasPrint')}}">
					<i class="fa fa-print"></i> Imprimir Reporte
                </a>
            </div>
        </div>
     </div>
</div>


