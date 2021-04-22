  @csrf
  <div class="row">
    <div class="col-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Nombre Empresa:</strong>
            <input class="form-control{{ $errors->has('cfe_nombre') ? ' is-invalid' : '' }} "  name="cfe_nombre" id="cfe_nombre" type="text" value="{{ old('cfe_nombre') }}" required>
        </div>
    </div>

</div>
 <div class="row">
    <div class="col-12 col-sm-6 col-md-6">
        <div class="form-group">
            <strong>Dirección:</strong>
            <input class="form-control{{ $errors->has('cfe_direccion') ? ' is-invalid' : '' }} "  name="cfe_direccion" id="cfe_direccion" type="text" value="{{ old('cfe_direccion') }}" required>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-md-6">
        <div class="form-group">
            <strong>Codigo Postal:</strong>
            <input class="form-control{{ $errors->has('cfe_codigo_postal') ? ' is-invalid' : '' }} "  name="cfe_codigo_postal" id="cfe_codigo_postal" type="text" value="{{ old('cfe_codigo_postal') }}" >
        </div>
    </div>
</div>
 <div class="row">
    <div class="col-12 col-sm-6 col-md-6">
        <div class="form-group">
            <strong>Teléfono:</strong>
            <input class="form-control{{ $errors->has('cfe_telefono') ? ' is-invalid' : '' }} "  name="cfe_telefono" id="cfe_telefono" type="text" value="{{ old('cfe_telefono') }}" required>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-md-6">
        <div class="form-group">
            <strong>Movil:</strong>
            <input class="form-control{{ $errors->has('cfe_movil') ? ' is-invalid' : '' }} "  name="cfe_movil" id="cfe_movil" type="text" value="{{ old('cfe_movil') }}" >
        </div>
    </div>
</div>
 <div class="row">
    <div class="col-12 col-sm-6 col-md-6">
        <div class="form-group">
            <strong>Prefijo de Empresa:</strong>
            <input class="form-control{{ $errors->has('cfe_prefijo_empresa') ? ' is-invalid' : '' }} "  name="cfe_prefijo_empresa" id="cfe_prefijo_empresa" type="text" value="{{ old('cfe_prefijo_empresa') }}" required>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-md-6">
        <div class="form-group">
            <strong>Codigo  Inicial de Empresa:</strong>
            <input class="form-control{{ $errors->has('cfe_empresa_inicial') ? ' is-invalid' : '' }} "  name="cfe_empresa_inicial" id="cfe_empresa_inicial" type="text" value="{{ old('cfe_empresa_inicial') }}"required >
        </div>
    </div>
    <div class="col-12 col-sm-6 col-md-6">
        <div class="form-group">
            <strong>Incremento de Codigo:</strong>
            <input class="form-control{{ $errors->has('cfe_empresa_incremento') ? ' is-invalid' : '' }} "  name="cfe_empresa_incremento" id="cfe_empresa_incremento" type="text" value="{{ old('cfe_empresa_incremento') }}" required>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-md-6">
        <div class="form-group">
            <strong>Dijitos para Codificación:</strong>
            <select class="form-control " name="cfe_dijitos_empresa" id="cfe_dijitos_empresa" required>
                <option value="">Seleccione</option>
                    @foreach($totalDigitos as $key => $totalDigito)
                    <option value="{{ $key }}">{{ $totalDigito }}</option>
                    @endforeach
            </select>
        </div>
    </div>
</div>
