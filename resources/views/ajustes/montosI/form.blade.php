@csrf
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <label>Monto Individual </label>
            <input id="mti_valor" type="number" class="form-control{{ $errors->has('mti_valor') ? ' is-invalid' : '' }}" name="mti_valor" value="{{ old('mti_valor') }}" required>
        </div>

    </div>
</div>
