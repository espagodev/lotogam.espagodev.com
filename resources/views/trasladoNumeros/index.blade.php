@extends('layouts.app')
@section('title','Numeros Para Traspasar')
    @section('content')

     <div class="row pt-2 pb-2">
        <div class="col-sm-9">
		    <h4 class="page-title">Numeros Para Traspasar</h4>
	   </div>
        <div class="col-sm-3">
            <div class="btn-group float-sm-right">
            </div>
        </div>
     </div>
       @include('reportes.partials.traslado_apuestas')
       @include('trasladoNumeros.partials.detalle')
      <div class="row">
          <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                            <div class="table-responsive">
                               <table class="table table-bordered table-striped table-sm"  id="control_apuestas">
                                    <thead>
                                        <tr>
                                            
                                            <th>Loteria</th>
                                            <th>Modalidad</th>
                                            <th>Numero</th>
                                            <th>Contador</th>
                                            <th>Trasladar</th>
                                            <th>Fecha</th>

                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr class="bg-gray font-17 footer-total text-center">
                                            <td colspan="3"></td>
                                            <td></td>
                                            <td></td>                                            
                                            <td></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                    </div>
                </div>
            </div>

    </div>
   @endsection
@section('scripts')
        <script src="{{ asset('js/trasladoApuestas.js?v=' . $asset_v) }}"></script>
 @endsection


