@csrf
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <label>Monto Global </label>
            <input id="mtg_valor" type="number" class="form-control{{ $errors->has('mtg_valor') ? ' is-invalid' : '' }}" name="mtg_valor" value="{{ old('mtg_valor') }}" required>
        </div>

    </div>
</div>
