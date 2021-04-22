  @csrf

 <div class="row">
    <div class="col-12 col-sm-6 col-md-6">
        <div class="form-group">
            <strong>Inicio Año Contable:</strong>
            <input class="form-control{{ $errors->has('cff_inicio_contable') ? ' is-invalid' : '' }} "  name="cff_inicio_contable" id="cff_inicio_contable" type="text" value="{{ old('cff_inicio_contable') }}" required>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-md-6">
        <div class="form-group">
            <strong>Fin Año Contable:</strong>
            <input class="form-control{{ $errors->has('cff_fin_contable') ? ' is-invalid' : '' }} "  name="cff_fin_contable" id="cff_fin_contable" type="text" value="{{ old('cff_fin_contable') }}"required >
        </div>
    </div>
</div>
 <div class="row">
    <div class="col-12 col-sm-6 col-md-6">
        <div class="form-group">
            <strong>Prefijo Factura:</strong>
            <input class="form-control{{ $errors->has('cff_prefijo_factura') ? ' is-invalid' : '' }} "  name="cff_prefijo_factura" id="cff_prefijo_factura" type="text" value="{{ old('cff_prefijo_factura') }}" required>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-md-6">
        <div class="form-group">
            <strong>Incremento para factura:</strong>
            <input class="form-control{{ $errors->has('cff_factura_incremento') ? ' is-invalid' : '' }} "  name="cff_factura_incremento" id="cff_factura_incremento" type="text" value="{{ old('cff_factura_incremento') }}"required >
        </div>
    </div>
</div>
<div class="row">
        <div class="col-12 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>Dijitos para Factura:</strong>
                <select class="form-control " name="cff_dijitos_factura" id="cff_dijitos_factura" required>
                    <option value="">Seleccione</option>
                        @foreach($totalDigitos as $key => $totalDigito)
                        <option value="{{ $key }}">{{ $totalDigito }}</option>
                        @endforeach
                </select>
            </div>
        </div>


    <div class="col-12 col-sm-6 col-md-6">
        <div class="form-group">
            <strong>Inpuestos:</strong>
            <input class="form-control{{ $errors->has('cff_impuestos') ? ' is-invalid' : '' }} "  name="cff_impuestos" id="cff_impuestos" type="text" value="{{ old('cff_impuestos') }}" required>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12 col-sm-6 col-md-6">
        <div class="form-group">
            <strong>Descuentos:</strong>
            <input  class="form-control{{ $errors->has('cff_descuentos') ? ' is-invalid' : '' }}" data-role="tagsinput" name="cff_descuentos" id="cff_descuentos" type="text" value="{{ old('cff_descuentos') }}"required >
        </div>
    </div>
</div>
