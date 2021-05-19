    <div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                        <label>Descripción</label>
                    <input id="mti_nombre"  type="text"  class="form-control{{ $errors->has('mti_nombre') ? ' is-invalid' : '' }}" name="mti_nombre" value="{{ old('mti_nombre',$montoIndividual->mti_nombre) }}" required>

                    @if ($errors->has('mti_nombre'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('mti_nombre') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-3 col-sm-3 col-md-3 ">
                <div class="form-group">
                        <label>Quinela </label>
                    <input  id="mti_quiniela" type="number" maxlength="2" class="form-control{{ $errors->has('mti_quiniela') ? ' is-invalid' : '' }}" name="mti_quiniela" value="{{ old('mti_quiniela',$montoIndividual->mti_quiniela) }}"required >

                    @if ($errors->has('mti_quiniela'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('mti_quiniela') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="col-xs-3 col-sm-3 col-md-3">
                <div class="form-group">
                        <label>Pale </label>
                    <input  id="mti_pale" type="number" maxlength="2" class="form-control{{ $errors->has('mti_pale') ? ' is-invalid' : '' }}" name="mti_pale" value="{{ old('mti_pale',$montoIndividual->mti_pale) }}" required>

                    @if ($errors->has('mti_pale'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('mti_pale') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="col-xs-3 col-sm-3 col-md-3">
                <div class="form-group">
                        <label>Tripleta </label>
                    <input id="mti_tripleta"  type="number" maxlength="2" class="form-control{{ $errors->has('mti_tripleta') ? ' is-invalid' : '' }}" name="mti_tripleta" value="{{ old('mti_tripleta',$montoIndividual->mti_tripleta) }}" required>

                    @if ($errors->has('mti_tripleta'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('mti_tripleta') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
             <div class="col-xs-3 col-sm-3 col-md-3">
                <div class="form-group">
                        <label>SuperPale </label>
                    <input id="mti_superpale"  type="number" maxlength="2" class="form-control{{ $errors->has('mti_superpale') ? ' is-invalid' : '' }}" name="mti_superpale" value="{{ old('mti_superpale',$montoIndividual->mti_superpale) }}" required>

                    @if ($errors->has('mti_superpale'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('mti_superpale') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
        </div>
    </div>
