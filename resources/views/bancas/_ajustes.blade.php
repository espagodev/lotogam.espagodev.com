
  <div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong><i class="fa fa-clock-o"></i> Zona Horaria:</strong>
                         <select class="form-control  single-select" name="emp_zona_horaria" id="emp_zona_horaria" required>
                            <option value="">Seleccione</option>
                                @foreach($zonasHoraria as $zonaHoraria)
                                <option value="{{ $zonaHoraria }}" >{{ $zonaHoraria }}</option>
                                @endforeach
                        </select>
                </div>
            </div>
             <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong><i class="fa fa-money"></i> Moneda:</strong>
                          <select class="form-control single-select" name="monedas_id" id="monedas_id" required>
                            <option value="">Seleccione</option>
                                @foreach($monedas as $moneda)
                                <option value="{{ $moneda->id }}" >{{ $moneda->pais }} - {{ $moneda->moneda }} ({{ $moneda->codigo }})  </option>
                                @endforeach
                        </select>
                </div>
            </div>
             <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                     <strong>Impresora:</strong>
                      <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-print"></i></span>
                        </div>
                        <select class="form-control " name="impresoras_pos_id" id="impresoras_pos_id" required>
                            <option value="">Seleccione</option>
                                @foreach($impresoras as $impresora)
                                <option value="{{ $impresora->id }}">{{ $impresora->imp_nombre }}</option>
                                @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                     <strong>Esquema Ticket:</strong>
                      <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-calculator"></i></span>
                        </div>
                        <select class="form-control " name="app_esquema_tickets_id" id="app_esquema_tickets_id" required>
                            <option value="">Seleccione</option>
                                @foreach($esquemas as $esquema)
                                <option value="{{ $esquema->id }}">{{ $esquema->eqt_nombre }}</option>
                                @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Configuracion Ticket:</strong>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-file-code-o"></i></span>
                        </div>
                        <select class="form-control " name="app_config_tickets_id" id="app_config_tickets_id" required>
                            <option value="">Seleccione</option>
                                @foreach($configuraciones as $configuracion)
                                <option value="{{ $configuracion->id }}">{{ $configuracion->tcon_nombre }}</option>
                                @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Listado de Premios:</strong>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-file-code-o"></i></span>
                            </div>
                            <select class="form-control " name="premios_id" id="premios_id" required>
                                <option value="">Seleccione</option>
                                    @foreach($premios as $premio)
                                    <option value="{{ $premio->id }}">{{ $premio->pre_nombre }}</option>
                                    @endforeach
                            </select>
                        </div>
                    </div>
                </div>
        </div>
    </div>
  </div>

