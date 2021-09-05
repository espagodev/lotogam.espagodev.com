
<div>
    <div class="row">
        <div class="col-xs-12 col-sm-8 col-md-8">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <label >Nombre</label>
                    <input class="mb-3 form-control form-control-lg" type="text" id="lot_nombre" name="lot_nombre" value="{{ old('lot_nombre',$loteria->lot_nombre ) }}" required>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <label >Abreviado</label>
                    <input id="lot_abreviado" type="text" class="mb-3 form-control{{ $errors->has('lot_abreviado') ? ' is-invalid' : '' }}"   name="lot_abreviado" value="{{ old('lot_abreviado',$loteria->lot_abreviado) }}" required>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="form-group">
                        <strong><i class="fa fa-clock-o"></i> Zona Horaria:</strong>
                             <select class="form-control  single-select" name="lot_zona_horaria" id="lot_zona_horaria" required>
                                <option value="">Seleccione</option>
                                    @foreach($zonasHoraria as $zonaHoraria)
                                    <option value="{{ $zonaHoraria }}" @if($zonaHoraria == old('lot_zona_horaria', $loteria->lot_zona_horaria)) selected @endif>{{ $zonaHoraria }}</option>
                                    @endforeach
                            </select>
                    </div>
                </div>
            </div>
              {{-- <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <label >Horario Cierre Lunes-Sabado</label>
                            <input id="sorteols" type="text" class="mb-3 form-control{{ $errors->has('lot_abreviado') ? ' is-invalid' : '' }} sorteols"   name="sorteo[l-s]" value="{{ old('sorteols',$loteria->sorteols) }}" required>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <label >Horario Cierre Domingo</label>
                            <input id="sorteod" type="text" class="mb-3 form-control{{ $errors->has('lot_codigo') ? ' is-invalid' : '' }} sorteod"   name="sorteo[d]" value="{{ old('sorteod',$loteria->sorteod) }}"  required>
                        </div>
                    </div> --}}
        
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="form-group">
                        <strong><i class="fa fa-flag" aria-hidden="true"></i> Pais:</strong>
                             <select class="form-control  single-select" name="lot_pais" id="lot_pais" >
                                <option value="">Seleccione</option>
                                    @foreach($zonasHoraria as $zonaHoraria)
                                    <option value="{{ $zonaHoraria }}" @if($zonaHoraria == old('lot_pais', $loteria->lot_pais)) selected @endif>{{ $zonaHoraria }}</option>
                                    @endforeach
                            </select>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="form-group">              
                        <strong><i class="fa fa-users" aria-hidden="true"></i> Grupo:</strong>
                             <select class="form-control  single-select" name="lot_grupo" id="lot_grupo" >
                                <option value="">Seleccione</option>
                                    @foreach($grupos as $key => $grupo)
                                    <option value="{{ $key }}" @if($key == old('lot_grupo', $loteria->lot_grupo)) selected @endif>{{ $grupo }}</option>
                                    @endforeach
                            </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="form-group">
                        <div class="icheck-material-info">
                            <input type="checkbox" id="lot_especial" name="lot_especial" value="1" disabled/>
                            <label for="lot_especial">Loteria Especial</label>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <label >Comision Loteria</label>
                    <input id="lot_comision" type="text" class="mb-3 form-control{{ $errors->has('lot_comision') ? ' is-invalid' : '' }}"   name="lot_comision" value="{{ old('lot_comision',$loteria->lot_comision ) }}" >
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                <label>Seleccionar Logo</label>
                    <input type="file" class="mb-3 form-control" id="lot_imagen" name="lot_imagen" >
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-4 col-md-4">
            <label>Modalidades</label>
        </div>
    </div>
</div>
   
