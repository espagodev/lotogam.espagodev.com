        <div class="col-lg-12">
            <div class="card card-default">
                <div class="card-header d-flex align-items-left">
                    <div class="d-flex justify-content-left col">
                        <div class="h4 m-0 text-left">Ajustes Adicionales</div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('bancas.update',$banca->id) }}" method="post" id="opciones_impresora_pos">
                        @csrf {{method_field('PUT')}}
                                                            <div class="row">
                                            <div class="col-xs-12 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <div class="icheck-material-info">
                                                        <input type="checkbox" id="ban_venta_futuro" value="1" name="ban_venta_futuro"  @if($banca->ban_venta_futuro) checked @endif/>
                                                        <label for="ban_venta_futuro">Venta a Futuro</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <div class="icheck-material-info">
                                                        <input type="checkbox" id="ban_promocion" value="1" name="ban_promocion"  @if($banca->ban_promocion) checked @endif/>
                                                        <label for="ban_promocion">Promocion</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <strong>Tiempo Limite de Cobro (Días):</strong>
                                                    <input class="form-control{{ $errors->has('ban_tiempo_cobro') ? ' is-invalid' : '' }}" name="ban_tiempo_cobro" id="ban_tiempo_cobro" type="number" value="{{ old('ban_tiempo_cobro', $banca->ban_tiempo_cobro) }}" >

                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <strong>Limite de Venta ({{ request()->session()->get('currency.symbol') }})</strong>
                                                    <input class="form-control{{ $errors->has('ban_limite_venta') ? ' is-invalid' : '' }}" name="ban_limite_venta" id="ban_limite_venta" type="number" value="{{ old('ban_limite_venta', $banca->ban_limite_venta) }}" >
                                                </div>
                                            </div>
                                        </div>
                                         <div class="row">
                                            <div class="col-xs-12 col-sm-6 col-md-6">

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
                                            <div class="col-xs-12 col-sm-6 col-md-6">
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

                                        </div>
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-6 col-md-6">
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
                                             <div class="col-xs-12 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <strong>Tiempo Limite de Para Anular Ticket (Minutos):</strong>
                                                    <input class="form-control{{ $errors->has('ban_tiempo_anular') ? ' is-invalid' : '' }}" name="ban_tiempo_anular" id="ban_tiempo_anular" type="number" value="{{ old('ban_tiempo_anular', $banca->ban_tiempo_anular) }}" >

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
