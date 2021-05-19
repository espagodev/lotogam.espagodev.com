<div class="modal-dialog" role="document">
        <div class="modal-content border-warning">

            <div class="modal-header bg-warning">
                <h3 class="modal-title text-white">Modificar Monto Individual</h3>
                <button type="button" class="close text-white no-print" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form method="post" action="{{ route('montosIndividuales.update', $montoIndividual->id)}}"  id="store">
             @csrf {{method_field('PUT')}}
                <div class="modal-body">
                    @include('ajustes.montosI.partials.form_edit')
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



