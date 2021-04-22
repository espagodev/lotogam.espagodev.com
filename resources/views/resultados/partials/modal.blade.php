

{{-- Modal para crear Ingresar resultados --}}

<div class="modal fade" id="nuevo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel">Agregar Resultado</h4><button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                {{-- <form method="post" action="{{ route('resultados.store')}}" enctype="multipart/form-data" id="store"> --}}

                @include('resultados.partials.form')
            </div>
            <div class="modal-footer">
                <button class="btn btn-danger cancelar" type="button" data-dismiss="modal" id="cancelar">Cancelar</button>
                <button class="btn btn-primary GuardarResultados" id="GuardarResultados" type="submit">Crear</button></div>
        </div>
        {{-- </form> --}}
    </div>
</div>

