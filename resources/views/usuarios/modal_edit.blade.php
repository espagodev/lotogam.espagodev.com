<div class="modal-dialog modal-xl" role="document">
        <div class="modal-content border-warning">

            <div class="modal-header bg-warning">
                <h3 class="modal-title text-white">Modificar Horario para la Loteria - {{ ($loteria->lot_nombre )}}</h3>
                <button type="button" class="close text-white no-print" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form method="post" action="{{ route('userLoterias.update',$loteria->id) }}"  id="store">
             @csrf {{method_field('PUT')}}
                <div class="modal-body">
                    <input type="hidden" id="users_id" name="users_id" value="{{ $users_id }}">
                    @include('usuarios.partials.form_edit')
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger no-print"
                        data-dismiss="modal"><i class="fa fa-times"></i> Cerrar
                    </button>
                     <button class="btn btn-success" type="submit"><i class="fa fa-check-square-o"></i> Modificar</button>

                </div>
             </form>
        </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->



