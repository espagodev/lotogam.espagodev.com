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
                                <table class="table table-striped" id="loterias">
                                    <thead>
                                        <tr>
                                            <th scope="col">Loteria</th>
                                            <th scope="col">Abreviado</th>
                                            <th scope="col">Horario</th>
                                            <th scope="col">Estado</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                    </div>
                </div>
            </div>
      </div><!--End Row-->
      <div class="modal fade view_register no-print" tabindex="-1" role="dialog"
        aria-labelledby="gridSystemModalLabel">
    </div>
   @endsection
    @section('scripts')
    <script src="{{ asset('js/ajustes/loterias/loteriasEmpresa.js?v=' . $asset_v) }}"></script>
    <script type="text/javascript">
    $(document).ready( function(){
        //Status table
         loterias = $('#loterias').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{action('EmpresaLoteriasController@index')}}",
                columnDefs: [ {
                    "targets": 3,
                    "orderable": false,
                    "searchable": false
                } ],
                columns: [
                    { data: 'lot_nombre', name: 'lot_nombre' },
                    { data: 'lot_abreviado', name: 'lot_abreviado' },
                    { data: 'horario', name: 'horario' },
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
                        // if (result.success == true) {
                        //     Lobibox.success(result.msg);
                        //     loterias.ajax.reload();
                        // } else {
                        //     toastr.error(result.msg);
                        // }
                    },
                });
            }
        });
    });

   </script>
    @endsection
