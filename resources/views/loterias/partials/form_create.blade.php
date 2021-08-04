    @csrf
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <label >Nombre</label>
                    <input class="mb-3 form-control form-control-lg" type="text" id="lot_nombre" name="lot_nombre" value="{{ old('lot_nombre' ) }}" required>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <label >Abreviado</label>
                    <input id="lot_abreviado" type="text" class="mb-3 form-control{{ $errors->has('lot_abreviado') ? ' is-invalid' : '' }}"   name="lot_abreviado" value="{{ old('lot_abreviado') }}" required>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <label >Codigo</label>
                    <input id="lot_codigo" type="text" class="mb-3 form-control{{ $errors->has('lot_codigo') ? ' is-invalid' : '' }}"   name="lot_codigo" value="{{ $totalLoterias }}" disabled>
                </div>
            </div>
              <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <label >Horario Cierre Lunes-Sabado</label>
                    <input id="sorteols" type="text" class="mb-3 form-control{{ $errors->has('lot_abreviado') ? ' is-invalid' : '' }} sorteols"   name="sorteo[l-s]" value="{{ old('sorteols') }}" required>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <label >Horario Cierre Domingo</label>
                    <input id="sorteod" type="text" class="mb-3 form-control{{ $errors->has('lot_codigo') ? ' is-invalid' : '' }} sorteod"   name="sorteo[d]" value="{{ old('sorteod') }}"  required>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="form-group">
                        <strong><i class="fa fa-clock-o"></i> Zona Horaria:</strong>
                             <select class="form-control  single-select" name="lot_zona_horaria" id="lot_zona_horaria" required>
                                <option value="">Seleccione</option>
                                    @foreach($zonasHoraria as $zonaHoraria)
                                    <option value="{{ $zonaHoraria }}" @if($zonaHoraria == old('lot_zona_horaria')) selected @endif>{{ $zonaHoraria }}</option>
                                    @endforeach
                            </select>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="form-group">
                        <div class="icheck-material-info">
                            <input type="checkbox" id="lot_especial" name="lot_especial" value="1" disabled/>
                            <label for="lot_especial">Loteria Especial</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                <label>Seleccionar Logo</label>
                    <input type="file" class="mb-3 form-control" id="lot_imagen" name="lot_imagen">
                </div>
            </div>
        
   
