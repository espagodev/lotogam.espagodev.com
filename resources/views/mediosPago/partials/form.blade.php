    @csrf
 <div class="row">
        <div class="col-xs-12 col-sm-2 col-md-2">
            <label > Abreviado</label>
            <input id="mep_abreviado" type="text" class="form-control{{ $errors->has('mep_abreviado') ? ' is-invalid' : '' }}"  name="mep_abreviado" value="{{ old('mep_abreviado') }}"required >
        </div>
        <div class="col-xs-12 col-sm-10 col-md-10">
            <label >Nombre Medio de Pago</label>
             <input id="mep_nombre" type="text" class="form-control{{ $errors->has('mep_nombre') ? ' is-invalid' : '' }}" name="mep_nombre" value="{{ old('mep_nombre') }}" required>
        </div>
    </div>
