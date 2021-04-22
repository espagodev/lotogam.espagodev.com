
        <div class="col-lg-12">
            <div class="card card-default">
                <div class="card-header d-flex align-items-left">
                    <div class="d-flex justify-content-left col">
                        <div class="h4 m-0 text-left">Impresora Pos</div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('bancas.update',$banca->id) }}" method="post" id="opciones_impresora_pos">
                        @csrf {{method_field('PUT')}}
                            <div class="row">
                                <div class="col-xs-12 col-sm-4 col-md-4">
                                <div class="form-group">
                                    <strong>Impresión automática después de finalizar:</strong>
                                        <select class="form-control " name="ban_imprimir_recibo" id="ban_imprimir_recibo" required disabled>
                                            <option value="">Seleccione</option>
                                                @foreach($impresionAutomaticas as $key => $impresionAutomatica)
                                                <option value="{{ $key }}"  @if($key == $banca->ban_imprimir_recibo) selected @endif>{{ $impresionAutomatica }}</option>
                                                @endforeach
                                        </select>
                                </div>
                                </div>
                                <div class="col-xs-12 col-sm-4 col-md-4">
                                    <div class="form-group">
                                    <strong>Tipo de impresora de recibos:</strong>
                                        <select class="form-control " name="ban_tipo_impresora" id="ban_tipo_impresora" required>
                                            <option value="">Seleccione</option>
                                                @foreach($tipoImpresoras as $key => $tipoImpresora)
                                                <option value="{{ $key }}"  @if($key == $banca->ban_tipo_impresora) selected @endif>{{ $tipoImpresora }}</option>
                                                @endforeach
                                        </select>
                                </div>
                                </div>
                                <div class="col-xs-12 col-sm-4 col-md-4" id="location_printer_div">
                                    <div class="form-group">
                                    <strong>Impresora:</strong>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-print"></i></span>
                                        </div>
                                        <select class="form-control " name="impresoras_pos_id" id="impresoras_pos_id" required>
                                            <option value="">Seleccione</option>
                                                @foreach($impresoras as $impresora)
                                                <option value="{{ $impresora->id }}"  @if($impresora->id == $banca->impresoras_pos_id) selected @endif>{{ $impresora->imp_nombre }}</option>
                                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-sm-6 col-md-6">
                                    <div class="form-group">
                                    <strong>Configuracion Ticket:</strong>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-file-code-o"></i></span>
                                        </div>
                                        <select class="form-control " name="app_config_tickets_id" id="app_config_tickets_id" required>
                                            <option value="">Seleccione</option>
                                                @foreach($configuraciones as $configuracion)
                                                <option value="{{ $configuracion->id }}" @if($configuracion->id == $banca->app_config_tickets_id) selected @endif>{{ $configuracion->tcon_nombre }}</option>
                                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                </div>
                                    <div class="col-xs-12 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <strong>Esquema Ticket:</strong>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-calculator"></i></span>
                                        </div>
                                        <select class="form-control " name="app_esquema_tickets_id" id="app_esquema_tickets_id" required>
                                            <option value="">Seleccione</option>
                                                @foreach($esquemas as $esquema)
                                                <option value="{{ $esquema->id }}"  @if($esquema->id == $banca->app_esquema_tickets_id) selected @endif>{{ $esquema->eqt_nombre }}</option>
                                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                </div>
                            </div>
                        <div class="form-footer">
                            <button type="submit" class="btn btn-success"><i class="fa fa-check-square-o"></i> MODIFICAR</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


