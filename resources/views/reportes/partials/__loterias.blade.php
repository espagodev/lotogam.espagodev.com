
    <div class="form-group">
            <strong>Loterias:</strong>
            <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-user"></i></span>
            </div>
            <select class="form-control " name="loterias_id" id="loterias_id">
                <option value="">Seleccione</option>
                @foreach($loterias as  $loteria)
                        <option value="{{ $loteria->loterias_id }}"  >{{ $loteria->lot_nombre}}</option>
                    @endforeach
            </select>
        </div>
    </div>

