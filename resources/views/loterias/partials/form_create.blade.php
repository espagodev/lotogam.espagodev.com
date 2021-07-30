    @csrf
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <label >Nombre</label>
            <input class="mb-3 form-control form-control-lg" type="text" id="lot_nombre" name="lot_nombre" value="{{ old('lot_nombre' ) }}" required>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-6">
            <label >Abreviado</label>
            <input id="lot_abreviado" type="text" class="mb-3 form-control{{ $errors->has('lot_abreviado') ? ' is-invalid' : '' }}"   name="lot_abreviado" value="{{ old('lot_abreviado') }}" required>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6">
            <label >Codigo</label>
            <input id="lot_codigo" type="text" class="mb-3 form-control{{ $errors->has('lot_codigo') ? ' is-invalid' : '' }}"   name="lot_codigo" value="{{ old('lot_codigo') }}" required>
        </div>
    </div>
      <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-6">
            <label >Horario Cierre Lunes-Sabado</label>
            <input id="sorteols" type="text" class="mb-3 form-control{{ $errors->has('lot_abreviado') ? ' is-invalid' : '' }} sorteols"   name="sorteo[l-s]" value="{{ old('sorteols') }}" required>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6">
            <label >Horario Cierre Domingo</label>
            <input id="sorteod" type="text" class="mb-3 form-control{{ $errors->has('lot_codigo') ? ' is-invalid' : '' }} sorteod"   name="sorteo[d]" value="{{ old('sorteod') }}"  required>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
        <label>Seleccionar Logo</label>
            <input type="file" class="mb-3 form-control" id="lot_imagen" name="lot_imagen" >
        </div>
    </div>
