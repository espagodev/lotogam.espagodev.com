
  <div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                     <strong>Zona Horaria:</strong>
                      <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-clock-o"></i></span>
                        </div>
                        <select class="form-control " name="ban_zonaHoraria" id="ban_zonaHoraria" required>
                            <option value="">Seleccione</option>
                                @foreach($zonasHoraria as $zonaHoraria)
                                <option value="{{ $zonaHoraria }}" @if($zonaHoraria == old('ban_zonaHoraria', $banca->ban_zonaHoraria)) selected @endif>{{ $zonaHoraria }}</option>
                                @endforeach
                        </select>
                    </div>
                </div>
            </div>
             <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                     <strong>Moneda:</strong>
                   <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-money"></i></span>
                        </div>
                          <select class="form-control " name="monedas_id" id="monedas_id" required>
                            <option value="">Seleccione</option>
                                @foreach($monedas as $moneda)
                                <option value="{{ $moneda->id }}"  @if($moneda->id == old('monedas_id', $banca->monedas_id)) selected @endif>{{ $moneda->pais }} - {{ $moneda->moneda }} ({{ $moneda->codigo }})  </option>
                                @endforeach
                        </select>
                    </div>
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
                                <option value="{{ $impresora->id }}"  @if($impresora->id == old('impresoras_pos_id', $banca->impresoras_pos_id)) selected @endif>{{ $impresora->imp_nombre }}</option>
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
                                <option value="{{ $esquema->id }}" @if($esquema->id == old('app_esquema_tickets_id', $banca->app_esquema_tickets_id)) selected @endif>{{ $esquema->eqt_nombre }}</option>
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
                                <option value="{{ $configuracion->id }}" @if($configuracion->id == old('app_config_tickets_id', $banca->app_config_tickets_id)) selected @endif>{{ $configuracion->tcon_nombre }}</option>
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
                                    <option value="{{ $premio->id }}" @if($premio->id == old('premios_id', $banca->premios_id)) selected @endif>{{ $premio->pre_nombre }}</option>
                                    @endforeach
                            </select>
                        </div>
                    </div>
                </div>
        </div>
    </div>
  </div>
