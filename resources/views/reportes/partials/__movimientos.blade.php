<div class="form-group">
        <strong>Movimientos:</strong>
        <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text"><i class="fa fa-level-up"></i></span>
        </div>
            <select class="form-control " name="movimiento" id="movimiento">
            <option value="">Seleccione</option>
               @foreach($movimientosCaja as $key => $movimientoCaja)
                <option value="{{ $key }}">{{ $movimientoCaja }}</option>
            @endforeach
        </select>
    </div>
</div>
