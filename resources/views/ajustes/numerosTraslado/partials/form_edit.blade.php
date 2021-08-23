    <div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                        <label>Descripción</label>
                    <input id="ntl_nombre"  type="text"  class="form-control{{ $errors->has('ntl_nombre') ? ' is-invalid' : '' }}" name="ntl_nombre" value="{{ old('ntl_nombre',$traslado->ntl_nombre) }}" required>

                    @if ($errors->has('ntl_nombre'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('ntl_nombre') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-3 col-sm-3 col-md-3 ">
                <div class="form-group">
                        <label>Quinela </label>
                    <input  id="ntl_quiniela" type="number" maxlength="2" class="form-control{{ $errors->has('ntl_quiniela') ? ' is-invalid' : '' }}" name="ntl_quiniela" value="{{ old('ntl_quiniela',$traslado->ntl_quiniela) }}"required >

                    @if ($errors->has('ntl_quiniela'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('ntl_quiniela') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="col-xs-3 col-sm-3 col-md-3">
                <div class="form-group">
                        <label>Pale </label>
                    <input  id="ntl_pale" type="number" maxlength="2" class="form-control{{ $errors->has('ntl_pale') ? ' is-invalid' : '' }}" name="ntl_pale" value="{{ old('ntl_pale',$traslado->ntl_pale) }}" required>

                    @if ($errors->has('ntl_pale'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('ntl_pale') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="col-xs-3 col-sm-3 col-md-3">
                <div class="form-group">
                        <label>Tripleta </label>
                    <input id="ntl_tripleta"  type="number" maxlength="2" class="form-control{{ $errors->has('ntl_tripleta') ? ' is-invalid' : '' }}" name="ntl_tripleta" value="{{ old('ntl_tripleta',$traslado->ntl_tripleta) }}" required>

                    @if ($errors->has('ntl_tripleta'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('ntl_tripleta') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
             <div class="col-xs-3 col-sm-3 col-md-3">
                <div class="form-group">
                        <label>SuperPale </label>
                    <input id="ntl_superpale"  type="number" maxlength="2" class="form-control{{ $errors->has('ntl_superpale') ? ' is-invalid' : '' }}" name="ntl_superpale" value="{{ old('ntl_superpale',$traslado->ntl_superpale) }}" required>

                    @if ($errors->has('ntl_superpale'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('ntl_superpale') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
        </div>
    </div>
