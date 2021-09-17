
<div class="row">
    <div class="col-xs-12 col-sm-6 col-md-6">
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
    <div class="col-xs-12 col-sm-6 col-md-6" id="location_printer_div">
        <div class="form-group">
            <strong>Impresora:</strong>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-print"></i></span>
                </div>
                <select class="form-control " name="impresoras_pos_id" id="impresoras_pos_id" required>
                    <option value="">Seleccione</option>
                        @foreach($impresoras as $impresora)
                        <option value="{{ $impresora->id }}" @if($impresora->id == $banca->impresoras_pos_id) selected @endif >{{ $impresora->imp_nombre }}</option>
                        @endforeach
                </select>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-12 col-sm-6 col-md-6" id="location_printer_div">

        <span><i class="fa fa-print"></i>  Descarga  El archivo para Imprimir <a href="{{ asset('printServer/pos_print_server_v1.7.7z') }}">Aquí</a></span>

    </div>
</div>