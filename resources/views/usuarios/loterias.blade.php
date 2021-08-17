@extends('layouts.app')
@section('title', 'Listado Loterias Usuario')
@section('content')
<div class="row pt-2 pb-2">
    <div class="col-sm-9">
        <h4 class="page-title">Usuario / Listado de Loterias</h4>
    </div>
    <div class="col-sm-3">
        <div class="btn-group float-sm-right">

        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-1">

    </div>
    <div class="col-lg-9">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <input type="hidden" id="users_id" value="{{ $users_id }}">
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
</div>
<!--End Row-->
<div class="modal fade view_register no-print" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
</div>
@endsection
@section('scripts')
<script src="{{ asset('js/usuarios/loterias.js?v=' . $asset_v) }}"></script>

<script type="text/javascript">
       $(document).ready( function(){
        //Status table
       
         loterias = $('#loterias').DataTable({        
                processing: true,
                serverSide: true,
                'ajax': {
                    url: "{{action('UserLoteriasController@loterias', [$users_id])}}",
                    // data: function (d) {
                    //     d.users_id = $('#users_id').val();
                    // }
                },
                // ajax: {
                //      url: '/userLoterias',
                //      dataType: "json",
                //         data: function(d) {
                //             d.users_id = $('#users_id').val();                               
                //         }
                // },
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
    $(document).on('click', 'button.activar-inactivar-loteria', function() {
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
                                title: false,
                                icon: false,
                                size: "mini",
                                rounded: true,
                                msg: result.msg,
                            });
                            loterias.ajax.reload();
                        }
                        if (result.success == "activo") {
                            Lobibox.notify("info", {
                                position: "top right",
                                title: false,
                                icon: false,
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
