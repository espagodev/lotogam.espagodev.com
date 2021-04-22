@extends('layouts.app')
    @section('content')
     <div class="row pt-2 pb-2">
        <div class="col-sm-9">
		    <h4 class="page-title"><i class="fa fa-desktop"></i> Ajustes Banca Monto Global / {{ $banca->ban_nombre }}</h4>
	   </div>
        <div class="col-sm-3">
           @include('ajustesBanca.partials.regresar')
        </div>
     </div>

        <div class="row">
             <div class="col-lg-4">
                 @include('ajustesBanca._sidebar')
            </div>
            <div class="col-lg-8">
                <div class="row">
                      @include('ajustesBanca.montosG.partials.listado')

                    </div>
            </div>
      </div><!--End Row-->
   @endsection
       @include('ajustesBanca.montosG.partials.modal')
         @section('scripts')
        <script>
          $(document).ready(function(){

               $('#nuevo, #actualizar').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget) // Button that triggered the modal
                var recipient = button.data('whatever')
                var botton = button.data('botton')
                var modalidad = button.data('modalidad')
                var modal = $(this)
                modal.find('.modal-body #modalidades_id').val(modalidad)
                modal.find('.modal-title').text(recipient)
                modal.find('.btn-primary').text(botton)
                });



                $('#actualizar').on('show.bs.modal', function (event) {
               var button = $(event.relatedTarget) // Button that triggered the modal
                var recipient = button.data('whatever')
                var botton = button.data('botton')
                var modalidad = button.data('modalidad')
                var modal = $(this)
                modal.find('.modal-body #modalidades_id').val(modalidad)
                modal.find('.modal-title').text(recipient)
                modal.find('.btn-primary').text(botton)
                });
            });

        </script>
    @endsection
