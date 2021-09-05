@extends('layouts.app')
@section('title', 'Listado Loterias')
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
                                <table class="table table-striped" id="loterias">
                                    <thead>
                                        <tr>
                                            <th scope="col">Logo</th>
                                            <th scope="col">Nombre Loteria</th>
                                            <th scope="col">Abreviado</th>
                                            <th scope="col">Estado</th>
                                            <th scope="col">Opciones</th>
                                        </tr>
                                    </thead>
                                    {{-- <tbody>
                                        @foreach($loterias as $key => $loteria)
                                        <tr>
                                           
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
                                                <a data-href="{{action('LoteriasController@getModificarLoteria', [$loteria->id]) }}"  class="btn btn-outline-warning modificar-modal" rel="tooltip" title="Editar Comision" ><i class="fa fa-pencil"></i></a>
                                               
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody> --}}
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
 <script src="{{ asset('js/loterias/loteria_nueva.js?v=' . $asset_v) }}"></script>

 <script type="text/javascript">
    $(document).ready( function(){
        //Status table
         loterias = $('#loterias').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{action('LoteriasController@index')}}",
                columnDefs: [ {
                    "targets": 3,
                    "orderable": false,
                    "searchable": false
                } ],
                columns: [
                    { data: 'logo', name: 'logo' },
                    { data: 'lot_nombre', name: 'lot_nombre' },
                    { data: 'lot_abreviado', name: 'lot_abreviado' },
                    { data: 'estado', name: 'estado' },
                    { data: 'action', name: 'action' },
                ]
            });
    });

     $(document).on('click', 'button.activar-inactivar-loteria', function(){
        swal({
            title: "Estás seguro ?",
            icon: 'warning',
            buttons: true,
            dangerMode: true,
        }).then(willDelete => {
            if (willDelete) {
                $.ajax({
                    url: $(this).data('href'),
                    dataType: 'json',
                    success: function(result) {
                        if (result.success == "estado") {
                            Lobibox.notify("success", {
                                position: "top right",
                                title:false,
                                icon:false,
                                size: "mini",
                                rounded: true,
                                msg: result.msg,
                                });
                            loterias.ajax.reload();
                        }
                        if(result.success == "activo") {
                            Lobibox.notify("info", {
                                position: "top right",
                                title:false,
                                icon:false,
                                size: "mini",
                                rounded: true,
                                msg: result.msg,
                                        });
                                loterias.ajax.reload();
                        }
                    },
                });
            }
        });
    });

   </script>
@endsection
