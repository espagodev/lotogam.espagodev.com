<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>Bancas:</strong>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-map-marker"></i></span>
                                </div>
                                <select class="form-control " name="banca_id" id="banca_id">
                                    <option value="">Seleccione</option>
                                    @foreach ($bancas as $banca)
                                        <option value="{{ $banca->id }}">{{ $banca->ban_nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>Usuarios:</strong>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-user"></i></span>
                                </div>
                                <select class="form-control " name="users_id" id="users_id">
                                    <option value="">Seleccione</option>
                                    @foreach ($usuarios as $usuario)
                                                                <option value="{{ $usuario->id }}"  >{{ $usuario->name}}</option>
                                                            @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>Fecha:</strong>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                </div>
                                {{-- {!! Form::text('cag_fecha_movimiento', @format_datetime('now'), ['class' => 'form-control', 'readonly', 'required']); !!} --}}
                                <input
                                    class="form-control{{ $errors->has('cag_fecha_movimiento') ? ' is-invalid' : '' }}"
                                    name="cag_fecha_movimiento" id="cag_fecha_movimiento" type="text"
                                    value="{{ @format_datetime('now') }}" readonly required>
                            </div>

                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>Tipo de Movimiento:</strong>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-level-up"></i></span>
                                </div>
                                <select class="form-control " name="cag_movimiento" id="cag_movimiento">
                                    <option value="">Seleccione</option>
                                    @foreach ($movimientosCaja as $key => $movimientoCaja)
                                        <option value="{{ $key }}">{{ $movimientoCaja }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>Monto:</strong>
                            <input class="form-control{{ $errors->has('cag_monto') ? ' is-invalid' : '' }}"
                                name="cag_monto" id="cag_monto" type="text"
                                value="{{ @num_format(old('cag_monto')) }}" required>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <label for="cag_nota_movimiento" class="col-sm-3 col-form-label">Nota de Cierre</label>
                            <textarea rows="4" class="form-control" name="cag_nota_movimiento"
                                id="cag_nota_movimiento"></textarea>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>
<!--End Row-->

