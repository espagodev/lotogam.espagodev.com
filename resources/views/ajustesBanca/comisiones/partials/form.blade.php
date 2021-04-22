
    @csrf
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                    <label>Comisiones </label>
                    <select class="form-control" name="comisiones_id" id="comisiones_id" required>
                            <option value="">Seleccione</option>
                            @foreach($comisiones as $comision)
                                <option value="{{ $comision->id }} " >{{ $comision->com_valor }} % </option>
                            @endforeach
                    </select>
            </div>
        </div>
    </div>
