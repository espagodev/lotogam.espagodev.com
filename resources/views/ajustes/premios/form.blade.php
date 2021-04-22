@csrf
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <label>Modalidad</label>
                    <select class="form-control loterias" name="modalidades_id" id="modalidades_id" >
                        @foreach($modalidades as $modalidad)
                            <option {{ collect(old('mod_id'))->contains($modalidad->identificador) ? 'selected' : ''}} value="{{ $modalidad->identificador }}" >{{ $modalidad->modalidad }}</option>
                        @endforeach
                    </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4">
                <label >Premio 1°</label>
                <input type="text" class="form-control{{ $errors->has('pre_valor_1') ? ' is-invalid' : '' }}" placeholder="0" name="pre_valor_1" value="{{ old('pre_valor_1') }}" >
                @if ($errors->has('pre_valor_1'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('pre_valor_1') }}</strong>
                </span>
            @endif
        </div>
        <div class="col-sm-4">
                <label >Premio 2°</label>
                <input type="text" class="form-control{{ $errors->has('pre_valor_2') ? ' is-invalid' : '' }}" placeholder="0" name="pre_valor_2" value="{{ old('pre_valor_2') }}" >
                @if ($errors->has('pre_valor_2'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('pre_valor_2') }}</strong>
                </span>
            @endif
            </div>
        <div class="col-sm-4">
                <label >Premio 3°</label>
                <input type="text" class="form-control{{ $errors->has('pre_valor_3') ? ' is-invalid' : '' }}" placeholder="0" name="pre_valor_3" value="{{ old('pre_valor_3') }}" >
                @if ($errors->has('pre_valor_3'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('pre_valor_3') }}</strong>
                </span>
            @endif
        </div>
    </div>

