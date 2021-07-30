@extends('layouts.app')
    @section('content')
     <div class="row pt-2 pb-2">
        <div class="col-sm-9">
		    <h4 class="page-title">Loterias</h4>
	   </div>
        <div class="col-sm-3">
            <div class="btn-group float-sm-right">
                <button type="button" class="btn btn-primary waves-effect waves-primary nuevo-modal" data-href="{{action('LoteriasController@getNuevaLoteria') }}"><i class="fa fa-plus mr-1"></i> Nueva Loteria</button>
            </div>
        </div>
     </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Logo</th>
                                            <th scope="col">Nombre Loteria</th>
                                            <th scope="col">Abreviado</th>
                                            <th scope="col">Estado</th>
                                            <th scope="col">Opciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($loterias as $key => $loteria)
                                        <tr>
                                            {{-- @dump($loteria) --}}
                                            <td>
                                                <div class="media align-items-center">
                                                     <img src="{{$loteria->lot_imagen}}" class="customer-img rounded">
                                                </div>
                                            </td>
                                            <td>{{ $loteria->lot_nombre }}</td>
                                            <td>{{ $loteria->lot_abreviado }}</td>
                                           <td  class="card-body bt-switch">
                                                <input type="checkbox" data-id="{{$loteria->id}}"  data-size="small" data-on-color="success" data-off-color="default" data-on-text="<i class='fa fa-check-circle-o'></i>" data-off-text="<i class='fa  fa-ban'></i>" {{ $loteria->lot_estado ? 'checked' : '' }}>
                                            </td>
                                            <td>
                                                 <a data-href="{{action('LoteriasController@getModificarComision', [$loteria->id]) }}"  class="btn btn-outline-warning modificar-modal" rel="tooltip" title="Editar Comision" ><i class="fa fa-pencil"></i></a>
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
 <script src="{{ asset('js/loterias/loteria.js?v=' . $asset_v) }}"></script>
@endsection
