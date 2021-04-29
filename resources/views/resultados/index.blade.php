@extends('layouts.app')
@section('title', 'Resultados')
    @section('content')
     <div class="row pt-2 pb-2">
        <div class="col-sm-9">
		    <h4 class="page-title">Resultados Loterias</h4>
	   </div>
        <div class="col-sm-3">
            <div class="btn-group float-sm-right">
                <button type="button" class="btn btn-info waves-effect waves-light"   id="resultados" ><i class="fa fa-print m-1"></i></button>
                <button type="button" class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target="#nuevo"><i class="fa fa-plus m-1"></i> Nuevo Resultado</button>
            </div>
        </div>
     </div>

      @include('reportes.partials.resultados')
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                            <div class="table-responsive">
                                 <table class="table table-bordered table-striped"  id="reporte_resultados"> 
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
                            </div>
                    </div>
                </div>
            </div>
      </div><!--End Row-->
   @endsection
      @include('resultados.partials.modal')
   @section('scripts')
    <script src="{{ asset('js/resultados.js?v=' . $asset_v) }}"></script>
     <script type="text/javascript">
        var token = '{{ csrf_token() }}';
    </script>
    <script>

      $('#res_fecha').datepicker({
        autoclose: true,
        todayHighlight: true,
         format: 'dd/mm/yyyy',
        startDate: '-4d',
        endDate: '0d',
        language: "es"
      });

      function fn_saltar(pre_premio,orden)
        {
            if(orden == 1 && pre_premio.value.length == 2)
                $("#res_premio2").focus();
            else if(orden == 2 && pre_premio.value.length == 2)
                $("#res_premio3").focus();
	    }
      </script>
   @endsection


