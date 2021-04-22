@extends('layouts.app')
@section('title', 'Tipos Documento')
    @section('content')
     <div class="row pt-2 pb-2">
        <div class="col-sm-9">
		    <h4 class="page-title">Tipos de Documento</h4>
	   </div>
        <div class="col-sm-3">
            <div class="btn-group float-sm-right">
                <button type="button" class="btn btn-primary waves-effect waves-primary" data-toggle="modal" data-target="#nuevo" data-whatever="Nuevo Tipo de Documento" data-botton="Guardar"><i class="fa fa-plus mr-1"></i> Nuevo Documento</button>

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
                                        @foreach($documentos as $key => $documento)
                                        <tr>
                                            <td>{{ $documento->abreviado}}</td>
                                            <td>{{ $documento->documento}}</td>
                                            <td  class="card-body bt-switch">
                                                <input class="toggle-class" type="checkbox" data-id="{{$documento->identificador}}"  data-size="small" data-on-color="success" data-off-color="default" data-on-text="<i class='fa fa-check-circle-o'></i>" data-off-text="<i class='fa  fa-ban'></i>" {{ $documento->estado ? 'checked' : '' }}>
                                            </td>
                                            <td>
                                                 <a href="#" data-toggle="modal"  data-target="#actualizar" data-whatever="Actualizar Tipo de Documento" data-botton="Modificar" data-id="{{ $documento->identificador }}"  data-abreviado="{{ $documento->abreviado }}" data-nombre="{{ $documento->documento }}"  class="btn btn-outline-warning"><i class="fa fa-pencil"></i></a>
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
    @include('tiposDocumento.partials.modal')
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
                    modal.find('.modal-body #doc_abreviado').val(abreviado)
                    modal.find('.modal-body #doc_nombre').val(nombre)
                    modal.find('.modal-body #tiposdocumento_id').val(id)
                    modal.find('.btn-primary').text(botton)
                        });
                    });
            $(function() {
                $('.toggle-class').change(function() {
                    var doc_estado = $(this).prop('checked') == true ? 1 : 0;
                    var tiposdocumento_id = $(this).data('id');

                    $.ajax({
                        type: "GET",
                        dataType: "json",
                        url: '/tiposDocumento/estado',
                        data: {'doc_estado': doc_estado, 'tiposdocumento_id': tiposdocumento_id},
                        success: function(data){

                        }
                    });
                })
            })
    </script>
@endsection
