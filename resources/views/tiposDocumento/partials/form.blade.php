    @csrf
     <div class="row">
        <div class="col-xs-12 col-sm-4 col-md-4">
            <label >Abreviado</label>
            <input id="doc_abreviado" type="text" class="form-control{{ $errors->has('doc_abreviado') ? ' is-invalid' : '' }}"  name="doc_abreviado" value="" required>
        </div>
        <div class="col-xs-12 col-sm-8 col-md-8">
            <label >Nombre</label>
            <input id="doc_nombre" type="text" class="form-control{{ $errors->has('doc_nombre') ? ' is-invalid' : '' }}"  name="doc_nombre" value="" required >
        </div>
    </div>
