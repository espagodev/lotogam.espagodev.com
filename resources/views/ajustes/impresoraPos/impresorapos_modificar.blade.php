<div class="modal-dialog" role="document">
        <div class="modal-content border-info">

            <div class="modal-header bg-info">
                <h3 class="modal-title text-white">Modificar Impresora Pos</h3>
                <button type="button" class="close text-white no-print" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form method="post" action="{{ route('impresoraPos.update', $impresora->id)}}"  id="store">
             @csrf {{method_field('PUT')}}
                <div class="modal-body">
                     <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <label >Nombre Impresora</label>
                                <input type="text" id="imp_nombre" class="form-control{{ $errors->has('imp_nombre') ? ' is-invalid' : '' }}" placeholder="Nombre descriptivo corto para reconocer la impresora" name="imp_nombre" value="{{ old('imp_nombre', $impresora->imp_nombre) }}" required>
                                @if ($errors->has('imp_nombre'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('imp_nombre') }}</strong>
                                </span>
                            @endif
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                            <strong>Tipo de conexión:</strong>
                                    <select class="form-control " name="imp_conexion" id="imp_conexion" required>
                                        @foreach($conexiones as $key => $conexion)
                                        <option value="{{ $key }}" @if($key == old('imp_conexion', $impresora->imp_conexion)) selected @endif>{{ $conexion }}</option>
                                        @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                            <strong>Perfil:</strong>
                                    <select class="form-control" name="imp_perfil" id="imp_perfil" required>
                                        @foreach($capacidades as $key => $capacidad)
                                        <option value="{{ $key }}" @if($key == old('imp_perfil', $impresora->imp_perfil)) selected @endif>{{ $capacidad }}</option>
                                        @endforeach
                                    </select>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <label >Caracteres por Línea:</label>
                                <input id="imp_caracteres" type="text" class="form-control{{ $errors->has('imp_caracteres') ? ' is-invalid' : '' }}"  name="imp_caracteres" value="{{ old('imp_caracteres', $impresora->imp_caracteres) }}" >
                                @if ($errors->has('imp_caracteres'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('imp_caracteres') }}</strong>
                                </span>
                            @endif
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12" id="ip_address_div">
                            <div class="form-group">
                                <label >Dirección IP:</label>
                                <input id="imp_ip" type="text" class="form-control{{ $errors->has('imp_ip') ? ' is-invalid' : '' }}" placeholder="Dirección IP para conectarse a la impresora" name="imp_ip" value="{{ old('imp_ip', $impresora->imp_ip) }}" >
                                @if ($errors->has('imp_ip'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('imp_ip') }}</strong>
                                </span>
                            @endif
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12" id="port_div">
                            <div class="form-group">
                                <label >Puerto:</label>
                                <input name="id" type="text" class="form-control{{ $errors->has('imp_port') ? ' is-invalid' : '' }}"  name="imp_port" value="{{ old('imp_port', $impresora->imp_port) }}" >
                                @if ($errors->has('imp_port'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('imp_port') }}</strong>
                                </span>

                            @endif
                            <span class="help-block">La mayoría de las impresoras funcionan en el puerto 9100</span>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 hide" id="path_div">
                            <div class="form-group">
                                <label >Ruta:</label>
                                <input id="imp_ruta"  type="text" class="form-control{{ $errors->has('imp_ruta') ? ' is-invalid' : '' }}"  name="imp_ruta" value="{{ old('imp_ruta', $impresora->imp_ruta) }}" >
                                @if ($errors->has('imp_ruta'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('imp_ruta') }}</strong>
                                </span>
                            @endif
                            <span class="help-block">
                            <b>Tipo de conexión Windows: </b> Los archivos del dispositivo estarán en la línea de  <code>LPT1</code> (parallelo) / <code>COM1</code> (serial). <br/>
                            <b>Tipo de conexión Linux: </b> El archivo de su dispositivo de impresora estará en algún lugar como <code>/dev/lp0</code> (parallelo), <code>/dev/usb/lp1</code> (USB), <code>/dev/ttyUSB0</code> (USB-Serial), <code>/dev/ttyS0</code> (serial). <br/>
                            </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger no-print"
                        data-dismiss="modal"><i class="fa fa-times"></i> Cerrar
                    </button>
                     <button class="btn btn-success" type="submit"><i class="fa fa-check-square-o"></i> Modificar</button>

                </div>
             </form>
        </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->



