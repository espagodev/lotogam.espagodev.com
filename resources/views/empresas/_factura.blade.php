<div class="card-header">Detalldes de Facturación</div>
    <div class="card-body">
        <div class="row">
            <div class="col-xs-12 col-sm-4 col-md-4">
                <div class="form-group">
                    <strong>Numero de Factura:</strong>
                <input class="form-control" type="text" name="fac_numero" id="fac_numero" value="{{ $codigoFactura }}" readonly required >
                </div>
            </div>
             <div class="col-xs-12 col-sm-4 col-md-4">
                <div class="form-group">
                    <strong>Valor Plan:</strong>
                     <input class="form-control " type="text" name="fac_valor_facturado" id="fac_valor_facturado"   readonly required >
                </div>
            </div>
            <div class="col-xs-12 col-sm-4 col-md-4">
                <div class="form-group">
                <strong>Impuestos:{{ sprintf('Tax %s %%',$impuesto) }}</strong>
                     <input class="form-control" type="text" name="fac_valor_impuesto" id="fac_valor_impuesto"  value="0" readonly  >
                <input type="hidden" name="impuestos" id="impuestos" value="{{ $impuesto }}">
                    </div>
            </div>
        </div>
         <div class="row">
            <div class="col-xs-12 col-sm-3 col-md-3">
                <div class="form-group">
                    <strong>Descuento:</strong>
                     <select id="fac_descuento" name="fac_descuento" class="form-control">
                         <option value="0">No Aplica</option>
                              @foreach($descuento as $list)
                                <option value="{{ $list }}">{{ $list.'%' }}</option>
                              @endforeach
                    </select>
                </div>
            </div>
             <div class="col-xs-12 col-sm-3 col-md-3">
                <div class="form-group">
                    <strong>Valor Descuento:</strong>
                     <input class="form-control" type="text" name="fac_valor_descuento" id="fac_valor_descuento"  readonly >
                </div>
            </div>
             <div class="col-xs-12 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Nota Descuento:</strong>
                     <input class="form-control" type="text" name="fac_nota_descuento" id="fac_nota_descuento" > 
                </div>
            </div>

        </div>
    </div>
