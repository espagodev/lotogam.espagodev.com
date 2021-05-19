<div class="modal-dialog" role="document">
        <div class="modal-content border-info">

            <div class="modal-header bg-info">
                <h3 class="modal-title text-white">Nueva Comision</h3>
                <button type="button" class="close text-white no-print" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form method="post" action="{{ route('comisiones.store')}}"  id="store">
             @csrf
             <div class="modal-body">
                   @include('ajustes.comisiones.partials.form_create')
            </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger no-print"
                        data-dismiss="modal"><i class="fa fa-times"></i> Cerrar
                    </button>
                     <button class="btn btn-success" type="submit"><i class="fa fa-check-square-o"></i> Guaradar</button>

                </div>
             </form>
        </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->



