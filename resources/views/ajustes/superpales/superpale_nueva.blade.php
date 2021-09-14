<div class="modal-dialog modal-lg" role="document">
        <div class="modal-content border-info">

            <div class="modal-header bg-info">
                <h3 class="modal-title text-white">Nueva Loteria SuperPale</h3>
                <button type="button" class="close text-white no-print" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form method="post" action="{{ route('superPaleEmpresa.store')}}"  id="store">
             @csrf
                <div class="modal-body">                   
                    <!-- descripcion -->
                    <div class="row">
                    <div class="col-xs-12 col-sm-8 col-md-8">
                        <div class="form-group">
                                <strong>Nombre </strong>
                            <input id="lot_nombre" type="text" class="form-control{{ $errors->has('lot_nombre') ? ' is-invalid' : '' }}" name="lot_nombre" value="{{ old('lot_nombre') }}" required>
                            @if ($errors->has('lot_nombre'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('lot_nombre') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    
                        <div class="col-xs-12 col-sm-4 col-md-4">
                            <div class="form-group">
                                <strong>Abreviado:</strong>
                                <input class="form-control{{ $errors->has('lot_abreviado') ? ' is-invalid' : '' }}" name="lot_abreviado" id="lot_abreviado" type="text" value="{{ old('lot_abreviado') }}" required>
                            </div>
                        </div>
                       
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Loterias</strong>
                                    <select class="form-control loterias select2" name="loterias_id[]" id="loterias_id"  multiple="multiple" required>
                                        @foreach($loterias as $lot)
                                            <option  value="{{ $lot->id }}" >{{ $lot->lot_nombre }}</option>
                                        @endforeach
                                    </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger no-print"
                        data-dismiss="modal"><i class="fa fa-times"></i> Cerrar
                    </button>
                     <button class="btn btn-success" type="submit"><i class="fa fa-check-square-o"></i> Crear</button>

                </div>
             </form>
        </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->



