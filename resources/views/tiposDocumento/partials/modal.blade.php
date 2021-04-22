    <div class="modal fade" id="nuevo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel"></h4><button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('tiposDocumento.store')}}" id="store">
                    @include('tiposDocumento.partials.form')
                </div>
                <div class="modal-footer"><button class="btn btn-danger" type="button" data-dismiss="modal">Cancelar</button>
                    <button class="btn btn-primary" type="submit"></button></div>
            </div>
            </form>
        </div>
    </div>
    <div class="modal fade" id="actualizar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel"></h4><button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('tiposDocumento.update', $documento->identificador)}}" id="store">
                        {{method_field('PUT')}}
                        <input type="hidden" name="tiposdocumento_id" id="tiposdocumento_id"  value="">
                    @include('tiposDocumento.partials.form')
                </div>
                <div class="modal-footer"><button class="btn btn-danger" type="button" data-dismiss="modal">Cancelar</button>
                    <button class="btn btn-primary" type="submit">Modificar</button></div>
            </div>
            </form>
        </div>
    </div>
