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
                 @include('reportes.partials.__registro')
            </div>
             <div class="col-xs-12 col-sm-12 col-md-4">
                @include('reportes.partials.__fechas')
            </div>
        </div>
     </div>
</div>


