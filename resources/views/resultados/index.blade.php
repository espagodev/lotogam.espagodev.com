@extends('layouts.app')
@section('title', 'Resultados')
    @section('content')
     <div class="row pt-2 pb-2">
        <div class="col-sm-9">
		    <h4 class="page-title">Resultados Loterias</h4>
	   </div>
        <div class="col-sm-3">
            <div class="btn-group float-sm-right">
                <a href="#" type="button" class="btn btn-info  resultados_print" data-href="{{action('ResultadosController@getResultadosFechaPrint')}}">
					  <i class="fa fa-print"></i> Imprimir Resultados
                </a>
                <a href="#" data-href="{{action('ResultadosController@getNuevoResultado') }}"  class="btn btn-primary waves-effect waves-light nuevo-resultado" rel="tooltip" title="ingresar Resultado" ><i class="fa fa-plus m-1"></i>Nuevo Resultado</a>

            </div>
        </div>
     </div>

      @include('reportes.partials.resultados')
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                            {{-- <div class="table-responsive"> --}}
                                 <table class="table table-bordered table-striped table-sm"  id="reporte_resultados">
                                    <thead>
                                        <tr>
                                            <th>Loteria</th>
                                            <th>Fecha</th>
                                            <th>1 Premio</th>
                                            <th>2 Premio</th>
                                            <th>3 Premio</th>
                                            <th>Opciones</th>
                                        </tr>
                                    </thead>
                                </table>
                            {{-- </div> --}}
                    </div>
                </div>
            </div>
      </div><!--End Row-->
       <div class="modal fade nuevo_modal" tabindex="-1" role="dialog"
        aria-labelledby="gridSystemModalLabel">
    </div>
   @endsection
 @section('scripts')
    <script src="{{ asset('js/resultados.js?v=' . $asset_v) }}"></script>
     <script type="text/javascript">
        var token = '{{ csrf_token() }}';
    </script>

   @endsection




