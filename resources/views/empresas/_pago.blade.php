<div class="card-header">Forma de Pago</div>
    <div class="card-body">
        <div class="row">

        <div class="col-xs-12 col-sm-4 col-md-4">
            <div class="form-group">
                <strong>Cantidad Recibidad:</strong>
                <input class="form-control" type="text" name="dep_valor_pagado" id="dep_valor_pagado"   >
            </div>
        </div>
        <div class="col-xs-12 col-sm-4 col-md-4">
            <div class="form-group">
                <strong>Cantidad Pendiente:</strong>
                <input class="form-control" type="text" name="fac_valor_pendiente" id="fac_valor_pendiente"  readonly  >
            </div>
        </div>
            <div class="col-xs-12 col-sm-4 col-md-4">
            <div class="form-group">
                <strong>Forma de Pago:</strong>
                <select class="form-control" name="medios_pagos_id" id="medios_pagos_id" required>
                    <option value="">Seleccione</option>
                        @foreach($mediopagos as $mediopago)
                        <option value="{{ $mediopago->identificador }}" >{{ $mediopago->medioPago }}</option> 
                        @endforeach
                </select>
            </div>
        </div>
    </div>
</div>
