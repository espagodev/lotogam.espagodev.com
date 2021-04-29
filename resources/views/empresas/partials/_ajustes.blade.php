 <div class="card-header">Ajustes </div>
    <div class="card-body">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                 <div class="form-group">
                    <strong><i class="fa fa-clock-o"></i> Zona Horaria:</strong>
                         <select class="form-control  single-select" name="emp_zona_horaria" id="emp_zona_horaria" required>
                            <option value="">Seleccione</option>
                                @foreach($zonasHoraria as $zonaHoraria)
                                <option value="{{ $zonaHoraria }}" @if($zonaHoraria == old('time_zone', $empresa->emp_zona_horaria)) selected @endif>{{ $zonaHoraria }}</option>
                                @endforeach
                        </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong><i class="fa fa-money"></i> Moneda:</strong>
                          <select class="form-control single-select" name="monedas_id" id="monedas_id" required>
                            <option value="">Seleccione</option>
                                @foreach($monedas as $moneda)
                                <option value="{{ $moneda->id }}" @if($moneda->id == old('moneda', $empresa->monedas_id)) selected @endif>{{ $moneda->pais }} - {{ $moneda->moneda }} ({{ $moneda->codigo }})  </option>
                                @endforeach
                        </select>
                </div>
            </div>
        </div>
         <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong><i class="fa fa-arrows-h"></i> Ubicacion Simbolo de Moneda:</strong>
                         <select class="form-control " name="emp_ubicacion_simbolo_moneda" id="emp_ubicacion_simbolo_moneda" required>
                            <option value="">Seleccione</option>
                                @foreach($ubicacionSiombolos as $key => $ubicacionSiombolo)
                                <option value="{{ $key }}" @if($key == old('currency_symbol_placement', $empresa->emp_ubicacion_simbolo_moneda)) selected @endif>{{ $ubicacionSiombolo }}</option>
                                @endforeach
                        </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                     <strong>Formato de Fecha:</strong>
                      <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                        </div>
                         <select class="form-control" name="emp_formato_fecha" id="emp_formato_fecha" required>
                            <option value="">Seleccione</option>
                                @foreach($formatoFechas as $key => $formatoFecha)
                                <option value="{{ $key }}" @if($key == old('date_format', $empresa->emp_formato_fecha)) selected @endif>{{ $formatoFecha }}</option>
                                @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                     <strong>Formato de Hora:</strong>
                      <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-clock-o"></i></span>
                        </div>
                        <select class="form-control " name="emp_formato_hora" id="emp_formato_hora" required>
                            <option value="">Seleccione</option>
                                @foreach($formatoHoras as $key => $formatoHora)
                                <option value="{{ $key }}" @if($key == old('time_format', $empresa->emp_formato_hora)) selected @endif>{{ $formatoHora }}</option>
                                @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>

</div>

