@extends('layouts.app')
@section('title', 'Modalidades de Juego')
    @section('content')
     <div class="row pt-2 pb-2">
        <div class="col-sm-9">
		    <h4 class="page-title">Modalidades</h4>

	   </div>
        <div class="col-sm-3">
            <div class="btn-group float-sm-right">
                <button type="button" class="btn btn-primary waves-effect waves-primary" data-toggle="modal" data-target="#nuevo" data-whatever="Nueva Modalidad" data-botton="Guardar"><i class="fa fa-plus mr-1"></i> Nueva Modalidad</button>

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
                                            <th scope="col">Abreviado</th>
                                            <th scope="col">Modalidad</th>
                                            <th scope="col">Estado</th>
                                            <th scope="col">Opciones</th>
                                        </tr>

                                    </thead>
                                    <tbody>
                                        @foreach($modalidades as $key => $modalidad)
                                        <tr>
                                            <td>{{ $modalidad->abreviado}}</td>
                                            <td>{{ $modalidad->modalidad }}</td>
                                             <td  class="bt-switch">
                                                <input type="checkbox" data-id="{{$modalidad->identificador}}" {{ $modalidad->estado ? 'checked' : '' }} data-size="small" data-on-color="success" data-off-color="default" data-on-text="<i class='fa fa-check-circle-o'></i>" data-off-text="<i class='fa  fa-ban'></i>" >
                                            </td>
                                            <td>
                                                 <a href="#" data-toggle="modal"  data-target="#actualizar" data-whatever="Actualizar Medio de Pago" data-botton="Modificar" data-id="{{ $modalidad->identificador }}" data-codigo="{{ $modalidad->codigo }}" data-abreviado="{{ $modalidad->abreviado }}" data-nombre="{{ $modalidad->modalidad }}"  class="btn btn-outline-warning"><i class="fa fa-pencil"></i></a>

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
 @include('modalidades.partials.modal')
@section('scripts')
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
                    var id = button.data('id')
                    var abreviado = button.data('abreviado')
                    var codigo = button.data('codigo')
                    var nombre = button.data('nombre')
                    var botton = button.data('botton')

                    var modal = $(this)
                    modal.find('.modal-title').text(recipient)
                    modal.find('.modal-body #mod_abreviado').val(abreviado)
                    modal.find('.modal-body #mod_nombre').val(nombre)
                    modal.find('.modal-body #mod_codigo').val(codigo)
                    modal.find('.modal-body #modalidades_id').val(id)
                    modal.find('.btn-primary').text(botton)

                        });
                    });

    </script>
@endsection

