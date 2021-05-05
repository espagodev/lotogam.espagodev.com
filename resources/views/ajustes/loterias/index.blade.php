@extends('layouts.app')
@section('title', 'Listado Loterias Empresa')
    @section('content')
     <div class="row pt-2 pb-2">
        <div class="col-sm-9">
		    <h4 class="page-title">Ajustes Empresa / Listado de Loterias</h4>
	   </div>
        <div class="col-sm-3">
            <div class="btn-group float-sm-right">

            </div>
        </div>
     </div>

        <div class="row">
             <div class="col-lg-3">
                 @include('ajustes._sidebar')
            </div>
            <div class="col-lg-9">

                <div class="card">
                    <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Loteria</th>
                                            <th scope="col">Abreviado</th>
                                            <th scope="col">Horario</th>
                                            <th scope="col">Estado</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($loteriasEmpresa as $key => $loteriaEmpresa)
                                        {{-- @dump($loteriasEmpresa) --}}
                                         @if($loteriaEmpresa->lot_superpale == '0')
                                            <tr>
                                                <td>{{ $loteriaEmpresa->lot_nombre }}</td>
                                                <td>{{ $loteriaEmpresa->lot_abreviado }}</td>
                                                <td>
                                                    @if($loteriaEmpresa->loe_estado != null)
                                                <a href="{{ route('ajustesLoterias.show', $loteriaEmpresa->id) }}" class="btn btn-outline-info btn-sm" rel="tooltip" title="Horario de la Loteria" >
                                                <i class="fa fa-clock-o"></i>
                                                </a>
                                                @endif
                                            </td>
                                            <td  class="card-body bt-switch">
                                                    <input type="checkbox" data-href="{{ action('EmpresaLoteriasController@getEmpresaLoteriaEstado') }}" data-id="{{$loteriaEmpresa->id}}" {{ $loteriaEmpresa->loe_estado ? 'checked' : '' }} data-size="small" data-on-color="success" data-off-color="default" data-on-text="<i class='fa fa-check-circle-o'></i>" data-off-text="<i class='fa  fa-ban'></i>" >

                                                </td>
                                            </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                    </div>
                </div>
            </div>
      </div><!--End Row-->
   @endsection
    @section('scripts')
     {{-- <script src="{{ asset('js/ajustes/loterias/loteriasEmpresa.js?v=' . $asset_v) }}"></script> --}}
 <script>

        $(function() {

           $(".bt-switch input[type='checkbox']").on('switchChange.bootstrapSwitch', function (e, data) {
                    var loe_estado = $(this).prop('checked') == true ? 1 : 0;
                    var loterias_id = $(this).data('id');

                     var data =  {'loe_estado': loe_estado, 'loterias_id': loterias_id};
                     $.ajax({
                        method: 'GET',
                        url: $(this).data('href'),

                        dataType: 'json',
                        data: data,

                        success: function(result) {
                             console.log(result);
                                if (result.success == true) {


                                    Lobibox.notify("success", {
                                        pauseDelayOnHover: true,
                                        size: "mini",
                                        rounded: true,
                                        delayIndicator: false,
                                        continueDelayOnInactiveTab: false,
                                        position: "top right",
                                        msg: result.msg,
                                    });
                                } else {
                                    // toastr.error(result.msg);
                                        Lobibox.notify("error", {
                                        pauseDelayOnHover: true,
                                        size: "mini",
                                        rounded: true,
                                        delayIndicator: false,
                                        continueDelayOnInactiveTab: false,
                                        position: "top right",
                                        msg: result.msg,
                                    });
                                }
                        }
                    });
            });
    });
   </script>
    @endsection
