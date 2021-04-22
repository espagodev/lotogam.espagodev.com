@csrf
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
             <div class="form-group">
                <label >Nombre Impresora</label>
                <input type="text" id="imp_nombre" class="form-control{{ $errors->has('imp_nombre') ? ' is-invalid' : '' }}" placeholder="Nombre descriptivo corto para reconocer la impresora" name="imp_nombre" value="{{ old('imp_nombre') }}" required>
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
                        <option value="{{ $key }}">{{ $conexion }}</option>
                        @endforeach
                </select>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
               <strong>Perfil:</strong>
                    <select class="form-control" name="imp_perfil" id="imp_perfil" required>
                        @foreach($capacidades as $key => $capacidad)
                        <option value="{{ $key }}">{{ $capacidad }}</option>
                        @endforeach
                    </select>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
             <div class="form-group">
                <label >Caracteres por Línea:</label>
                <input id="imp_caracteres" type="text" class="form-control{{ $errors->has('imp_caracteres') ? ' is-invalid' : '' }}"  name="imp_caracteres" value="42" >
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
                <input id="imp_ip" type="text" class="form-control{{ $errors->has('imp_ip') ? ' is-invalid' : '' }}" placeholder="Dirección IP para conectarse a la impresora" name="imp_ip" value="{{ old('imp_ip') }}" >
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
                <input name="id" type="text" class="form-control{{ $errors->has('imp_port') ? ' is-invalid' : '' }}"  name="imp_port" value="9100" >
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
                <input id="imp_ruta"  type="text" class="form-control{{ $errors->has('imp_ruta') ? ' is-invalid' : '' }}"  name="imp_ruta" value="{{ old('imp_ruta') }}" >
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
