@extends('layouts.app')
@section('title', 'Montos Individuales  Empresa')
    @section('content')
     <div class="row pt-2 pb-2">
        <div class="col-sm-9">
		    <h4 class="page-title">Ajustes Empresa</h4>
	   </div>
        <div class="col-sm-3">
            <div class="btn-group float-sm-right">
               <button type="button" class="btn btn-primary waves-effect waves-primary nuevo-modal" data-href="{{action('MontosIndividualesController@getNuevoMontoIndividual') }}"><i class="fa fa-plus mr-1"></i> Nuevo Monto Individual</button>

            </div>
        </div>
     </div>

        <div class="row">
             <div class="col-lg-4">
                 @include('ajustes._sidebar')
            </div>
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                            <div class="table-responsive">
                               <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Descripción</th>
                                            <th scope="col">Estado</th>
                                            <th scope="col">Opciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($montosIndividuales as $key => $montoIndividual)
                                        <tr>
                                            <td>{{$montoIndividual->mti_nombre }}</td>
                                             <td  class="card-body bt-switch">
                                                    <input type="checkbox" data-id="{{$montoIndividual->id}}" {{ $montoIndividual->mti_estado ? 'checked' : '' }} data-size="small" data-on-color="success" data-off-color="default" data-on-text="<i class='fa fa-check-circle-o'></i>" data-off-text="<i class='fa  fa-ban'></i>" >
                                                </td>
                                                <td>
                                                    <a data-href="{{action('MontosIndividualesController@getModificarMontoIndividual', [$montoIndividual->id]) }}"  class="btn btn-outline-warning modificar-modal" rel="tooltip" title="Editar MontoGlobal" ><i class="fa fa-pencil"></i></a>
                                                </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                    </div>
                </div>
            </div>
      </div><!--End Row-->
    <div class="modal fade nuevo_modal" tabindex="-1" role="dialog"
        aria-labelledby="gridSystemModalLabel">
    </div>
    <div class="modal fade modificar_modal" tabindex="-1" role="dialog"
        aria-labelledby="gridSystemModalLabel">
    </div>
   @endsection
@section('scripts')
 <script src="{{ asset('js/ajustes/montosIndividuales/montosIndividuales.js?v=' . $asset_v) }}"></script>
@endsection

