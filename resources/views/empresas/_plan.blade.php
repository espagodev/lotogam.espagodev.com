 <div class="card-header">Plan</div>
    <div class="card-body">
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-6"> 
                <div class="form-group plan-id">
                    <strong>Tipo de Plan:</strong>
                <select class="form-control " name="planes_id" id="planes_id" required>
                        <option value="">Seleccione</option>
                            @foreach($planes as $plan)
                            <option value="{{ $plan->identificador }}" data-precio="{{ $plan->planValor }}" data-days="{{ $plan->planTiempo }}">{{ $plan->plan }}</option>
                            @endforeach
                    </select>
                    <div class="price">

                        <input type="hidden" name="price" id="price">
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-3 col-md-3">
                <div class="form-group sus_fecha_inicio">
                    <strong>Fecha de Inicio:</strong>
                <input class="form-control{{ $errors->has('sus_fecha_inicio') ? ' is-invalid' : '' }}  datepicker-startdate " data-date-format="yyyy-mm-dd" name="sus_fecha_inicio" id="sus_fecha_inicio" type="text" value="{{ $fechaInicial }}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-3 col-md-3">
                <div class="form-group sus_fecha_fin">
                    <strong>Fecha de Fin:</strong>
                    <input class="form-control" type="text" name="sus_fecha_fin" id="sus_fecha_fin"  readonly required >
                </div>
            </div>
        </div>
    </div>
