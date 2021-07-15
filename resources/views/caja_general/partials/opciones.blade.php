 <div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-3">
                @include('caja_general.partials.__bancas')
            </div>
            <div class="col-xs-12 col-sm-12 col-md-3">
                @include('caja_general.partials.__usuarios')
            </div>
            <div class="col-xs-12 col-sm-12 col-md-3">
                @include('reportes.partials.__fechas')
            </div>
            <div class="col-xs-12 col-sm-12 col-md-3">
                 @include('reportes.partials.__movimientos')
            </div>
        </div>

    </div>
</div>
