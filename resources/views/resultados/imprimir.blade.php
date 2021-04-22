
    @csrf
    <!-- descripcion -->
    <div class="row">
        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group ">
                    <label>Fecha</label>
                <input id="res_fecha" type="text" class="form-control{{ $errors->has('res_fecha') ? ' is-invalid' : '' }}" name="res_fecha" value="" >

                @if ($errors->has('res_fecha'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('res_fecha') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div>
