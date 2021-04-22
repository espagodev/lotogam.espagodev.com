@csrf

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <label>Valor Comision % </label>
            <input id="com_valor" type="number" class="form-control{{ $errors->has('com_valor') ? ' is-invalid' : '' }}" name="com_valor" value="{{ old('com_valor') }}" required >
        </div>

    </div>
</div>
