    @csrf
    <div class="form-group">
            <label>Nombre Modalidad </label>
        <input id="mod_nombre" type="text" class="form-control{{ $errors->has('mod_nombre') ? ' is-invalid' : '' }}" name="mod_nombre" value="{{ old('mod_nombre') }}" required>

        @if ($errors->has('mod_nombre'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('mod_nombre') }}</strong>
            </span>
        @endif
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-4 col-md-4">
            <label >Abreviado</label>
            <input id="mod_abreviado" type="text" class="form-control{{ $errors->has('mod_abreviado') ? ' is-invalid' : '' }}"  name="mod_abreviado" value="{{ old('mod_abreviado') }}" required>
        </div>
        <div class="col-xs-12 col-sm-4 col-md-4">
            <label >Codigo</label>
            <input id="mod_codigo" type="text" class="form-control{{ $errors->has('mod_codigo') ? ' is-invalid' : '' }}"  name="mod_codigo" value="{{ old('mod_codigo') }}" required>
        </div>
    </div>
