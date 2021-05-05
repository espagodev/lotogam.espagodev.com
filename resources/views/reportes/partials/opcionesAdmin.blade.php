 <div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-4">
                @include('reportes.partials.__bancas')
            </div>
            <div class="col-xs-12 col-sm-12 col-md-4">
                @include('reportes.partials.__loterias')
            </div>
            <div class="col-xs-12 col-sm-12 col-md-4">
                @include('reportes.partials.__usuarios')
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-4">
                @include('reportes.partials.__fechas')
            </div>
            <div class="col-xs-12 col-sm-12 col-md-4">
                 @include('reportes.partials.__estados')
            </div>
            <div class="col-xs-12 col-sm-12 col-md-4">
                @include('reportes.partials.__promocion')
            </div>
        </div>

    </div>
</div>


