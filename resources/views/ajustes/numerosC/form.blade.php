
    @csrf
    <!-- descripcion -->
    <div class="form-group">
            <label>Numero </label>
        <input id="nuc_numero" type="number" class="form-control{{ $errors->has('nuc_numero') ? ' is-invalid' : '' }}" name="nuc_numero" value="{{ old('nuc_numero') }}" required>

        @if ($errors->has('nuc_numero'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('nuc_numero') }}</strong>
            </span>
        @endif
    </div>








