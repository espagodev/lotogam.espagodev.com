 <div class="form-group">
        <strong>Promocion:</strong>
        <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text"><i class="fa fa-gift"></i></span>
        </div>
            <select class="form-control " name="promocion" id="promocion">
            <option value="">Seleccione</option>
                @foreach($estadosPromocionTicket as $key => $estadoPromocionTicket)
                <option value="{{ $key }}">{{ $estadoPromocionTicket }}</option>
            @endforeach
        </select>
    </div>
</div>
