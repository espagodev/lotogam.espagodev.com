 <div class="card">
    <div class="card-body">
        <div class="row">
            @if((request()->session()->get('user.TipoUsuario') == 2))
            <div class="col-xs-12 col-sm-12 col-md-3">
                @include('caja_general.partials.__bancas')
            </div>
            <div class="col-xs-12 col-sm-12 col-md-3">
                @include('caja_general.partials.__usuarios')
            </div>
            @endif
            <div class="col-xs-12 col-sm-12 col-md-3">
                @include('reportes.partials.__fechas')
            </div>
            <div class="col-xs-12 col-sm-12 col-md-3">
                 @include('reportes.partials.__movimientos')
            </div>
        </div>

    </div>
</div>
