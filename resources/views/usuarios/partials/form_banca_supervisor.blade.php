<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <strong>Bancas</strong>
        <select class="form-control loterias select2" name="bancas_id[]" id="bancas_id"  multiple="multiple" required>
            @foreach($bancas as $banca)
                <option {{ collect(old('bancas_id', $usuario->bancas))->pluck('bancas_id')->contains($banca->id) ? 'selected' : ''}} value="{{ $banca->id }}" >{{ $banca->ban_nombre }}</option>
                
            @endforeach
        </select>
    </div>
</div>