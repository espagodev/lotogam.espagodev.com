
    @csrf
    <!-- descripcion -->
    <div class="row">
     <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
                <label>Loteria </label>
            <input id="lot_nombre" type="text" class="form-control{{ $errors->has('lot_nombre') ? ' is-invalid' : '' }}" name="lot_nombre" value="{{ old('lot_nombre') }}" required>
            @if ($errors->has('lot_nombre'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('lot_nombre') }}</strong>
                </span>
            @endif
        </div>
    </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>Abreviado:</strong>
                <input class="form-control{{ $errors->has('lot_abreviado') ? ' is-invalid' : '' }}" name="lot_abreviado" id="lot_abreviado" type="text" value="{{ old('lot_abreviado') }}" required>
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>Codigo:</strong>
                <input class="form-control{{ $errors->has('lot_codigo') ? ' is-invalid' : '' }}" name="lot_codigo" id="lot_codigo" type="text" value="{{ old('lot_codigo') }}" required>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <label>Loterias</label>
                    <select class="form-control loterias multiple-select" name="pal_id[]" id="pal_id"  multiple="multiple" required>
                        @foreach($loterias as $loteria)
                            <option {{ collect(old('pal_id'))->contains($loteria->identificador) ? 'selected' : ''}} value="{{ $loteria->identificador }}" >{{ $loteria->loteria }}</option>
                        @endforeach
                    </select>
            </div>
        </div>
    </div>





