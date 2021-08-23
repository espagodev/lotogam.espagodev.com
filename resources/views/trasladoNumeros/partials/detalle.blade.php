<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-2">
                <h5 class="mt-0">Nombre</h5>
                {{ $traslado->ntl_nombre }}
            </div>
            <div class="col-xs-12 col-sm-12 col-md-2">
                <h5 class="mt-0">Quiniela</h5>
                {{ $traslado->ntl_quiniela }}
            </div>
            <div class="col-xs-12 col-sm-12 col-md-2">
                <h5 class="mt-0">Pale</h5>
                {{ $traslado->ntl_pale }}
            </div>
            <div class="col-xs-12 col-sm-12 col-md-2">
                <h5 class="mt-0">Tripleta</h5>
                {{ $traslado->ntl_tripleta }}
            </div>
            <div class="col-xs-12 col-sm-12 col-md-2">
                <h5 class="mt-0">SuperPale</h5>
                {{ $traslado->ntl_superpale }}
            </div>
            <div class="col-xs-12 col-sm-12 col-md-2">
                <a href="#"  class="btn btn-info numeros-traslado" data-href="{{action('TrasladoNumerosController@getPrintReporteTrasladoNumeros')}}">
					<i class="fa fa-print"></i> Imprimir Reporte
                </a>
            </div>
        </div>
    </div>
</div>