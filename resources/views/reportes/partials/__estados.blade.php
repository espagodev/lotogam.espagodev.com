<div class="form-group">
        <strong>Estado:</strong>
        <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text"><i class="fa fa-level-up"></i></span>
        </div>
            <select class="form-control " name="movimiento" id="movimiento">
            <option value="">Seleccione</option>
                @foreach($estadosTicket as $key => $estadoTicket)
                <option value="{{ $key }}">{{ $estadoTicket }}</option>
            @endforeach
        </select>
    </div>
</div>
