@extends('layouts.app')
@section('title', 'Medios de Pago')
    @section('content')
     <div class="row pt-2 pb-2">
        <div class="col-sm-9">
		    <h4 class="page-title">Medios de Pago</h4>

	   </div>
        <div class="col-sm-3">
            <div class="btn-group float-sm-right">
                <button type="button" class="btn btn-primary waves-effect waves-primary" data-toggle="modal" data-target="#nuevo" data-whatever="Nuevo Medio de Pago" data-botton="Guardar"><i class="fa fa-plus mr-1"></i> Nuevo Medio de Pago</button>

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
                                            <th scope="col">Nombre</th>
                                            <th scope="col">Estado</th>
                                            <th scope="col">Opciones</th>
                                        </tr>

                                    </thead>
                                    <tbody>
                                        @foreach($mediosPago as $key => $medioPago)
                                        <tr>
                                            <td>{{ $medioPago->abreviado}}</td>
                                            <td>{{ $medioPago->medioPago}}</td>
                                             <td  class="card-body bt-switch">
                                                <input type="checkbox" data-id="{{$medioPago->identificador}}"  data-size="small" data-on-color="success" data-off-color="default" data-on-text="<i class='fa fa-check-circle-o'></i>" data-off-text="<i class='fa  fa-ban'></i>" {{ $medioPago->estado ? 'checked' : '' }}>
                                            </td>
                                            <td>
                                               <a href="#" data-toggle="modal"  data-target="#actualizar" data-whatever="Actualizar Medio de Pago" data-botton="Modificar" data-id="{{ $medioPago->identificador }}"  data-abreviado="{{ $medioPago->abreviado }}" data-nombre="{{ $medioPago->medioPago }}"  class="btn btn-outline-warning"><i class="fa fa-pencil"></i></a>
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
    @include('mediosPago.partials.modal')
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
                    var nombre = button.data('nombre')
                    var botton = button.data('botton')

                    var modal = $(this)
                    modal.find('.modal-title').text(recipient)
                    modal.find('.modal-body #mep_abreviado').val(abreviado)
                    modal.find('.modal-body #mep_nombre').val(nombre)
                    modal.find('.modal-body #mediopago_id').val(id)
                    modal.find('.btn-primary').text(botton)
                        });
                    });

    </script>
@endsection
