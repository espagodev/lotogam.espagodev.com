@extends('layouts.app')
@section('title', 'loterias SuperPale')
    @section('content')
     <div class="row pt-2 pb-2">
        <div class="col-sm-9">
		    <h4 class="page-title"><i class="fa fa-desktop"></i> Loterias SuperPale / {{ $banca->ban_nombre }}</h4>
	   </div>
        <div class="col-sm-3">
            @include('ajustesBanca.partials.regresar')
        </div>
     </div>

    <div class="row">
             <div class="col-lg-3">
                <input type="hidden" id="banca_url" value="{{ $banca->ban_url }}">
                 @include('ajustesBanca._sidebar')
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
                                        <th scope="col">Estado</th>
                                        <th scope="col"></th>
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
    @endsection
    @section('scripts')
    <script type="text/javascript">
        $(document).ready( function(){ 
            //Status table
        
            loterias = $('#loterias').DataTable({        
                    processing: true,
                    serverSide: true,
                    // ajax: 'ajustesBanca/loterias?banca=' + banca,
                    ajax: {
                        url: '/ajustesBanca/superpale',
                        dataType: "json",
                            data: function(d) {
                                d.banca = $('#banca_url').val();                               
                            }
                    },
                    columnDefs: [ {
                        
                        "orderable": false,
                        "searchable": false
                    } ],
                    columns: [
                        { data: 'lot_nombre', name: 'lot_nombre' },
                        { data: 'lot_abreviado', name: 'lot_abreviado' },                        
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
