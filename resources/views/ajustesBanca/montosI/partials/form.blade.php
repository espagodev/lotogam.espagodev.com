
    @csrf
    <!-- descripcion -->
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                    <label>Montos Individuales </label>
                    <select class="form-control{{ $errors->has('montos_individuales_id') ? ' is-invalid' : '' }} validar" name="montos_individuales_id" id="montos_individuales_id" >
                            <option value="">Seleccione</option>
                            @foreach($montosIndividuales as $montoIndividual)
                                <option value="{{ $montoIndividual->id }}" @if($montoIndividual->id == old('montos_individuales_id')) selected @endif >{{ $montoIndividual->mti_valor }}  </option>
                            @endforeach
                    </select>
            </div>
        </div>
    </div>
