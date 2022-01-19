    @csrf
            <div class="row">
                <div class="col-xs-12 col-sm-8 col-md-8">
                    <label >Nombre</label>
                    <input class="mb-3 form-control{{ $errors->has('lot_nombre') ? ' is-invalid' : '' }}" type="text" id="lot_nombre" name="lot_nombre" value="{{ old('lot_nombre' ) }}" required>
                </div>
            
                <div class="col-xs-12 col-sm-4 col-md-4">
                    <label >Abreviado</label>
                    <input id="lot_abreviado" type="text" class="mb-3 form-control{{ $errors->has('lot_abreviado') ? ' is-invalid' : '' }}"   name="lot_abreviado" value="{{ old('lot_abreviado') }}" required>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-4 col-md-4">
                    <div class="form-group">
                        <strong><i class="fa fa-clock-o"></i> Zona Horaria:</strong>
                             <select class="form-control" name="lot_zona_horaria" id="lot_zona_horaria" required>
                                <option value="">Seleccione</option>
                                    @foreach($zonasHoraria as $zonaHoraria)
                                    <option value="{{ $zonaHoraria }}" @if($zonaHoraria == old('lot_zona_horaria')) selected @endif>{{ $zonaHoraria }}</option>
                                    @endforeach
                            </select>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-4 col-md-4">
                    <div class="form-group">
                        <strong><i class="fa fa-flag" aria-hidden="true"></i> Pais:</strong>
                             <select class="form-control" name="lot_zona_horaria" id="lot_zona_horaria" required>
                                <option value="">Seleccione</option>
                                    @foreach($zonasHoraria as $zonaHoraria)
                                    <option value="{{ $zonaHoraria }}" @if($zonaHoraria == old('lot_zona_horaria')) selected @endif>{{ $zonaHoraria }}</option>
                                    @endforeach
                            </select>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-4 col-md-4">
                    <div class="form-group">
                        <strong><i class="fa fa-users" aria-hidden="true"></i> Grupo:</strong>
                        <select class="form-control" name="lot_grupo" id="lot_grupo" >
                            <option value="">Seleccione</option>
                                @foreach($grupos as $key => $grupo)
                                <option value="{{ $key }}" @if($key == old('lot_grupo')) selected @endif>{{ $grupo }}</option>
                                @endforeach
                        </select>
                    </div>
                </div>
            </div>
              <div class="row">
                <div class="col-xs-12 col-sm-4 col-md-4">
                    <label >Horario Cierre Lunes-Sabado</label>
                    <input id="lot_horario_cierre_ls" type="text" class="mb-3 form-control{{ $errors->has('lot_horario_cierre_ls') ? ' is-invalid' : '' }} "   name="lot_horario_cierre_ls" value="{{ old('lot_horario_cierre_ls') }}" required>
                </div>
                <div class="col-xs-12 col-sm-4 col-md-4">
                    <label >Horario Cierre Domingo</label>
                    <input id="lot_horario_cierre_d" type="text" class="mb-3 form-control{{ $errors->has('lot_horario_cierre_d') ? ' is-invalid' : '' }} "   name="lot_horario_cierre_d" value="{{ old('lot_horario_cierre_d') }}"  required>
                </div>
                <div class="col-xs-12 col-sm-4 col-md-4">
                    <label >Minutos antes de Cierre</label>
                    <input id="lot_minutos_cierre" type="number" class="mb-3 form-control{{ $errors->has('lot_minutos_cierre') ? ' is-invalid' : '' }} "   name="lot_minutos_cierre" value="{{ old('lot_minutos_cierre') }}"  required>
                </div>
                
            </div>
           
            <div class="row">                
                
                <div class="col-xs-12 col-sm-4 col-md-4">
                    <label >Comision Loteria</label>
                    <input id="lot_comision" type="number" class="mb-3 form-control{{ $errors->has('lot_comision') ? ' is-invalid' : '' }}"   name="lot_comision" value="{{ old('lot_comision' ) }}" >
                </div>
                <div class="col-xs-12 col-sm-4 col-md-4">
                    <div class="form-group">
                        <strong><i class="fa fa-users" aria-hidden="true"></i> Jornada:</strong>
                        <select class="form-control" name="lot_jornada" id="lot_jornada" >
                            <option value="">Seleccione</option>
                                @foreach($jornadas as $key => $jornada)
                                <option value="{{ $key }}" @if($key == old('lot_jornada')) selected @endif>{{ $jornada }}</option>
                                @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-4 col-md-4">
                    <div class="form-group">
                        <div class="icheck-material-info">
                            <input type="checkbox" id="lot_especial" name="lot_especial" value="1" disabled/>
                            <label for="lot_especial">Loteria Especial</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-6">
                <label>Seleccionar Logo</label>
                    <input type="file" class="mb-3 form-control" id="lot_imagen" name="lot_imagen">
                </div>
           
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <label>Modalidades</label>
                    <select class="form-control loterias select2" name="modalidades_id[]" id="modalidades_id"  multiple="multiple" required>
                        @foreach($modalidades as $modalidad)
                            <option {{ collect(old('modalidades_id'))->contains($modalidad->identificador) ? 'selected' : ''}} value="{{ $modalidad->identificador }}" >{{ $modalidad->modalidad }}</option>
                            
                        @endforeach
                    </select>
                </div>
            </div>
        
   
