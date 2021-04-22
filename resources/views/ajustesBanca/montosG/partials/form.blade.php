
    @csrf
    <!-- descripcion -->

    <div class="row">

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                    <label>Monto Global </label>
                    <select class="form-control{{ $errors->has('montos_globales_id') ? ' is-invalid' : '' }} validar" name="montos_globales_id" id="montos_globales_id" >
                            <option value="">Seleccione</option>
                            @foreach($montosGlobales as $montoGlobal)
                                <option value="{{ $montoGlobal->id }}" @if($montoGlobal->id == old('montos_globales_id')) selected @endif >{{ $montoGlobal->mtg_valor }}  </option>
                            @endforeach
                    </select>
            </div>
        </div>
    </div>
