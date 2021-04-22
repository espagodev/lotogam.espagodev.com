@extends('layouts.app')
@section('title', 'Listado Impresoras Pos')
    @section('content')
     <div class="row pt-2 pb-2">
        <div class="col-sm-9">
		    <h4 class="page-title">Ajustes Empresa / Impresoras Pos</h4>
	   </div>
        <div class="col-sm-3">
            <div class="btn-group float-sm-right">
                <button type="button" class="btn btn-primary waves-effect waves-primary" data-whatever="Agregar Nueva Impresora" data-botton="Guardar" data-toggle="modal" data-target="#nuevo"><i class="fa fa-plus mr-1"></i> Nueva Impresora</button>

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
                                            <th scope="col">Impresora</th>
                                            <th scope="col">Ruta</th>
                                            <th scope="col">Estado</th>
                                            <th scope="col">Opciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($impresoras as $key => $impresora)
                                        <tr>
                                            <td>{{ $impresora->imp_nombre}}</td>
                                            <td>{{ $impresora->imp_ruta}}</td>
                                            <td  class="card-body bt-switch">
                                                <input type="checkbox" data-id="{{$impresora->id}}" {{ $impresora->imp_estado ? 'checked' : '' }} data-size="small" data-on-color="success" data-off-color="default" data-on-text="<i class='fa fa-check-circle-o'></i>" data-off-text="<i class='fa  fa-ban'></i>" >
                                            </td>
                                            <td>
                                                   <a href="#" data-toggle="modal"  data-target="#actualizar" data-whatever="Actualizar Impresora" data-botton="Actualizar"
                                                data-nombre="{{ $impresora->imp_nombre }}" data-conexion="{{ $impresora->imp_conexion }}" data-prefil="{{ $impresora->imp_perfil }}"
                                                data-caracteres="{{ $impresora->imp_caracteres }}" data-ip="{{ $impresora->imp_ip }}" data-port="{{ $impresora->imp_port }}"
                                                data-ruta="{{ $impresora->imp_ruta }}"
                                             class="btn btn-outline-warning" rel="tooltip" title="Editar Impresora" >
                                                    <i class="fa fa-pencil"></i>
                                                </a>
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
   @include('ajustes.impresoraPos.partials.modal')
@section('scripts')
 <script>
    $(".bt-switch input[type='checkbox'], .bt-switch input[type='radio']").bootstrapSwitch();
     </script>
      <script>
          $(document).ready(function(){

                $('#nuevo').on('show.bs.modal', function (event) {

                var button = $(event.relatedTarget) // Button that triggered the modal
                var recipient = button.data('whatever')
                var botton = button.data('botton')
                var modal = $(this)
                modal.find('.modal-title').text(recipient)
                modal.find('.btn-primary').text(botton)

                });

                $('#actualizar').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget) // Button that triggered the modal
                var recipient = button.data('whatever')
                var botton = button.data('botton')
                var nombre = button.data('nombre')
                var conexion = button.data('conexion')
                var prefil = button.data('prefil')
                var caracteres = button.data('caracteres')
                var ip = button.data('ip')
                var port = button.data('port')
                var ruta = button.data('ruta')
                printer_connection_type_field(conexion);

                var modal = $(this)
                modal.find('.modal-body #imp_nombre').val(nombre)
                modal.find('.modal-body #imp_conexion').val(conexion)
                modal.find('.modal-body #imp_prefil').val(prefil)
                modal.find('.modal-body #imp_caracteres').val(caracteres)
                modal.find('.modal-body #imp_ip').val(ip)
                modal.find('.modal-body #imp_port').val(port)
                modal.find('.modal-body #imp_ruta').val(ruta)
                modal.find('.modal-title').text(recipient)
                modal.find('.btn-primary').text(botton)
                });
            });

        </script>
@endsection
