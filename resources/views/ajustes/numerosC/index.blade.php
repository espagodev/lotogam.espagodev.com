@extends('layouts.app')
@section('title', 'Numero Calientes Empresa')
    @section('content')
     <div class="row pt-2 pb-2">
        <div class="col-sm-9">
		    <h4 class="page-title">Ajustes Empresa</h4>

	   </div>
        <div class="col-sm-3">
            <div class="btn-group float-sm-right">
                <button type="button" class="btn btn-primary waves-effect waves-primary" data-toggle="modal" data-target="#nuevo"><i class="fa fa-plus mr-1"></i> Nuevo Numero Caliente</button>

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
                                            <th scope="col">Numero</th>
                                            <th scope="col">Estado</th>
                                            <th scope="col">Opciones</th>
                                        </tr>
                                    </thead>
                                     <tbody>
                                        @foreach($numerosCalientes as $key => $numeroCaliente)
                                            <tr>
                                                <td>{{ $numeroCaliente->nuc_numero }}</td>
                                                <td  class="card-body bt-switch">
                                                <input type="checkbox" data-href="{{ action('NumerosCalientesController@getNumerosCalientesEstado') }}" data-id="{{$numeroCaliente->id}}" {{ $numeroCaliente->nuc_estado ? 'checked' : '' }} data-size="small" data-on-color="success" data-off-color="default" data-on-text="<i class='fa fa-check-circle-o'></i>" data-off-text="<i class='fa  fa-ban'></i>" >
                                            </td>
                                            <td >
                                                <button data-href="{{action('NumerosCalientesController@getNumerosCalientesDelete', $numeroCaliente->id)}}" class="btn btn-xs btn-danger eliminar_numero_caliente_button"><i class="fa fa-trash"></i></button>
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
   @endsection
    @section('scripts')
    
    <script>
        $(function() {
            $(".bt-switch input[type='checkbox']").on('switchChange.bootstrapSwitch', function (e, data) {
                        
                        var numero_id = $(this).data('id');
                        var data =  {'numero_id': numero_id};
                        $.ajax({
                            method: 'GET',
                            url: $(this).data('href'),
                            dataType: 'json',
                            data: data,
                            success: function(result) {
                                console.log(result);
                                    if (result.success == "estado") {
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
                                          
                                    }
                            }
                        });
                });
        });

        $(document).on('click', 'button.eliminar_numero_caliente_button', function() {
        swal({
            title: "Estás seguro ?",
            icon: 'warning',
            buttons: true,
            dangerMode: true,
        }).then(willDelete => {
            if (willDelete) {
                var href = $(this).data('href');
                var data = $(this).serialize();

                $.ajax({
                    method: 'GET',
                    url: href,
                    dataType: 'json',
                    data: data,
                    success: function(result) {

                        if (result.success === "delete") {
                             Lobibox.notify("success", {
                                position: "top right",
                                title:false,
                                icon:false,
                                size: "mini",
                                rounded: true,
                                msg: result.msg,
                                });

                        } else {
                            Lobibox.notify("error", {
                                position: "top right",
                                title:false,
                                icon:false,
                                size: "mini",
                                rounded: true,
                                msg: result.msg,
                                });
                        }
                    },
                });
            }
        });
    });

    </script>
    @endsection
   <div class="modal fade" id="nuevo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Agregar Numero Caliente</h4><button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('NumerosCalientes.store')}}" id="store">
                    @include('ajustes.numerosC.form')
                </div>
                <div class="modal-footer"><button class="btn btn-danger" type="button" data-dismiss="modal">Cancelar</button>
                    <button class="btn btn-primary" type="submit">Crear</button></div>
            </div>
            </form>
        </div>
    </div>
