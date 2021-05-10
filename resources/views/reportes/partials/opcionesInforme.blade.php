<div class="card">
    <div class="card-body">
        <div class="row">
             <div class="col-xs-12 col-sm-12 col-md-4">
            </div>
            <div class="col-xs-12 col-sm-12 col-md-4">
                  @if((request()->session()->get('user.TipoUsuario') == 2))
                    @include('reportes.partials.__bancas')
                  @endif
            </div>
            <div class="col-xs-12 col-sm-12 col-md-4">
                @include('reportes.partials.__fechas')
            </div>
        </div>
     </div>
</div>


