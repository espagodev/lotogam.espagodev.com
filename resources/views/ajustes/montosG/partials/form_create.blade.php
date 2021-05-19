@csrf
    <div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                        <label>Descripción</label>
                    <input id="mtg_nombre"  type="text"  class="form-control{{ $errors->has('mtg_nombre') ? ' is-invalid' : '' }}" name="mtg_nombre" value="{{ old('mtg_nombre') }}" required>

                    @if ($errors->has('mtg_nombre'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('mtg_nombre') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-3 col-sm-3 col-md-3 ">
                <div class="form-group">
                        <label>Quinela </label>
                    <input  id="mtg_quiniela" type="number" maxlength="2" class="form-control{{ $errors->has('mtg_quiniela') ? ' is-invalid' : '' }}" name="mtg_quiniela" value="{{ old('mtg_quiniela') }}"required >

                    @if ($errors->has('mtg_quiniela'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('mtg_quiniela') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="col-xs-3 col-sm-3 col-md-3">
                <div class="form-group">
                        <label>Pale </label>
                    <input  id="mtg_pale" type="number" maxlength="2" class="form-control{{ $errors->has('mtg_pale') ? ' is-invalid' : '' }}" name="mtg_pale" value="{{ old('mtg_pale') }}" required>

                    @if ($errors->has('mtg_pale'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('mtg_pale') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="col-xs-3 col-sm-3 col-md-3">
                <div class="form-group">
                        <label>Tripleta </label>
                    <input id="mtg_tripleta"  type="number" maxlength="2" class="form-control{{ $errors->has('mtg_tripleta') ? ' is-invalid' : '' }}" name="mtg_tripleta" value="{{ old('mtg_tripleta') }}" required>

                    @if ($errors->has('mtg_tripleta'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('mtg_tripleta') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
             <div class="col-xs-3 col-sm-3 col-md-3">
                <div class="form-group">
                        <label>SuperPale </label>
                    <input id="mtg_superpale"  type="number" maxlength="2" class="form-control{{ $errors->has('mtg_superpale') ? ' is-invalid' : '' }}" name="mtg_superpale" value="{{ old('mtg_superpale') }}" required>

                    @if ($errors->has('mtg_superpale'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('mtg_superpale') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
        </div>
    </div>
