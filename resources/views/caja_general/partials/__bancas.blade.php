<div class="form-group">
        <strong>Bancas:</strong>
        <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text"><i class="fa fa-map-marker"></i></span>
        </div>
        <select class="form-control " name="bancas_id" id="bancas_id">
            <option value="">Seleccione</option>
                {{-- @foreach($bancas as $banca)
                    <option value="{{ $banca->id }}"  >{{ $banca->ban_nombre}}</option>
                @endforeach --}}
        </select>
    </div>
</div>
