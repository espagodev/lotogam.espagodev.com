<div class="modal-dialog" role="document">
        <div class="modal-content border-warning">

            <div class="modal-header bg-warning">
                <h3 class="modal-title text-white">Agregar Nuevo Resultado Para la Loteria</h3>
                <button type="button" class="close text-white no-print" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>

            <div class="modal-body">
                  @include('resultados.partials.form')
            </div>

            <div class="modal-footer">
                <button class="btn btn-danger cancelar" type="button" data-dismiss="modal" id="cancelar">Cancelar</button>
                <button class="btn btn-primary GuardarResultados" id="GuardarResultados" type="submit">Crear</button></div>
            </div>

        </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->

