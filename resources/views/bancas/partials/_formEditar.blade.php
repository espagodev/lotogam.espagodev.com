 <form action="{{ route('bancas.update',$banca->id) }}" method="post">
            @csrf {{method_field('PUT')}}
            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-xs-12 col-sm-4 col-md-4">
                                    <div class="form-group">
                                        <strong>Codigo Banca:</strong>
                                        <input class="form-control{{ $errors->has('ban_cod') ? ' is-invalid' : '' }}" name="ban_cod" id="ban_cod" type="text" value="{{ old('ban_cod', $banca->ban_cod) }}" disabled >
                                    </div>
                                </div>
                                    <div class="col-xs-12 col-sm-8 col-md-8">
                                    <div class="form-group">
                                        <strong>Nombre Banca:</strong>
                                        <input class="form-control{{ $errors->has('ban_nombre') ? ' is-invalid' : '' }}" name="ban_nombre" id="ban_nombre" type="text" value="{{ old('ban_nombre', $banca->ban_nombre) }}" >
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <strong>Telefono:</strong>
                                            <input class="form-control{{ $errors->has('ban_telefono') ? ' is-invalid' : '' }}" name="ban_telefono" id="ban_telefono" type="text" value="{{ old('ban_telefono', $banca->ban_telefono) }}" >
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <strong>Movil:</strong>
                                            <input class="form-control{{ $errors->has('ban_movil') ? ' is-invalid' : '' }}" name="ban_movil" id="ban_movil" type="text" value="{{ old('ban_movil', $banca->ban_movil) }}" >
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <strong>Direccion:</strong>
                                            <input class="form-control{{ $errors->has('ban_direccion') ? ' is-invalid' : '' }}" name="ban_direccion" id="ban_direccion" type="text" value="{{ old('ban_direccion', $banca->ban_direccion) }}" >

                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <strong>Codigo Postal: (Opcional)</strong>
                                            <input class="form-control{{ $errors->has('ban_codpostal') ? ' is-invalid' : '' }}" name="ban_codpostal" id="ban_codpostal" type="text" value="{{ old('ban_codpostal', $banca->ban_codpostal) }}" >
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                              <div class="row">
                                    <div class="col-xs-12 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <strong>Email:</strong>
                                            <input class="form-control{{ $errors->has('ban_correo') ? ' is-invalid' : '' }}" name="ban_correo" id="ban_correo" type="text" value="{{ old('ban_correo', $banca->ban_correo) }}" >

                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <strong>Pagina Web</strong>
                                            <input class="form-control{{ $errors->has('ban_website') ? ' is-invalid' : '' }}" name="ban_website" id="ban_website" type="text" value="{{ old('ban_website', $banca->ban_website) }}" >
                                        </div>
                                    </div>
                                </div>

                        </div>
                    </div>
                     <div class="card">
                        <div class="card-body">
                              <div class="row">
                                    <div class="col-xs-12 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <strong>Tiempo Limite de Cobro (Días):</strong>
                                            <input class="form-control{{ $errors->has('ban_tiempo_cobro') ? ' is-invalid' : '' }}" name="ban_tiempo_cobro" id="ban_tiempo_cobro" type="text" value="{{ old('ban_tiempo_cobro', $banca->ban_tiempo_cobro) }}" >

                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <strong>Limite de Venta ({{ request()->session()->get('currency.symbol') }})</strong>
                                            <input class="form-control{{ $errors->has('ban_limite_venta') ? ' is-invalid' : '' }}" name="ban_limite_venta" id="ban_limite_venta" type="text" value="{{ old('ban_limite_venta', $banca->ban_limite_venta) }}" >
                                        </div>
                                    </div>
                                </div>

                        </div>
                    </div>
                     <div class="form-footer">
                        <button type="submit" class="btn btn-danger"><i class="fa fa-times"></i> CANCELAR</button>
                        <button type="submit" class="btn btn-success"><i class="fa fa-check-square-o"></i> Modificar</button>
                    </div>
            </div>
            <div class="col-lg-4">
                @include("bancas.partials._ajustes")
            </div>
</form>
