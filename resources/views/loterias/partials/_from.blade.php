

    <div class="modal fade" id="nuevo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel" ></h4><button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                         <form method="post" action="{{ route('loterias.store')}}" enctype="multipart/form-data" id="store">
                            @include('loterias.partials.form')
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-danger" type="button" data-dismiss="modal">Cancelar</button>
                        <button class="btn btn-primary" type="submit"></button></div>
                </div>
                </form>
            </div>
        </div>




    <div class="modal fade" id="actualizar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Modificar Loteria</h4><button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('loterias.update', $loteria->identificador)}}" enctype="multipart/form-data" id="store">
                    {{method_field('PUT')}}
                    <input type="hidden" name="loterias_id" id="loterias_id"  value="">
                    @include('loterias.partials.form')
                </div>
                <div class="modal-footer"><button class="btn btn-danger" type="button" data-dismiss="modal">Cancelar</button>
                    <button class="btn btn-primary" type="submit">Crear</button></div>
            </div>
            </form>
        </div>
    </div>
 @section('scripts')
 <script>
    $(".bt-switch input[type='checkbox'], .bt-switch input[type='radio']").bootstrapSwitch();
     </script>
      <script>
        $(document).ready(function () {
            $('.sorteols').timepicker({
               timeFormat: 'HH:mm',
                zindex:  999999,
                interval: 5,
                minTime: '7',
                maxTime: '10:00pm',
                defaultTime: '7',
                startTime: '07:00',
                dynamic: false,
                dropdown: true,
                scrollbar: true
            });
             $('.sorteod').timepicker({
                timeFormat: 'HH:mm ',
                zindex:  999999,
                interval: 5,
                minTime: '11',
                maxTime: '10:00pm',
                defaultTime: '11',
                startTime: '11:00',
                dynamic: false,
                dropdown: true,
                scrollbar: true
            });
        });
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
                var lot_id = button.data('id')
                var modal = $(this)
                modal.find('.modal-title').text(recipient)
                modal.find('.btn-primary').text(botton)
                modal.find('.modal-body #loterias_id').val(lot_id)
                $.ajax({
                            url: "/loterias/" + lot_id,
                            method: "get",

                            success: function (result) {
                               modal.find('.modal-body #lot_nombre').val(result.loteria)
                               modal.find('.modal-body #lot_abreviado').val(result.abreviado)
                               modal.find('.modal-body #lot_codigo').val(result.codigo)
                               modal.find('.modal-body #sorteols').val(result.sorteols)
                               modal.find('.modal-body #sorteod').val(result.sorteod)
                            },
                        });

                });
            });

        </script>
@endsection
