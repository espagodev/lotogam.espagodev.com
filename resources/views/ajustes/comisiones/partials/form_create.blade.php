@csrf
    <div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                        <label>Descripción</label>
                    <input id="com_nombre"  type="text"  class="form-control{{ $errors->has('com_nombre') ? ' is-invalid' : '' }}" name="com_nombre" value="{{ old('com_nombre') }}" required>

                    @if ($errors->has('com_nombre'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('com_nombre') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-3 col-sm-3 col-md-3 ">
                <div class="form-group">
                        <label>Quinela </label>
                    <input  id="com_quiniela" type="number" maxlength="2" class="form-control{{ $errors->has('com_quiniela') ? ' is-invalid' : '' }}" name="com_quiniela" value="{{ old('com_quiniela') }}"required >

                    @if ($errors->has('com_quiniela'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('com_quiniela') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="col-xs-3 col-sm-3 col-md-3">
                <div class="form-group">
                        <label>Pale </label>
                    <input  id="com_pale" type="number" maxlength="2" class="form-control{{ $errors->has('com_pale') ? ' is-invalid' : '' }}" name="com_pale" value="{{ old('com_pale') }}" required>

                    @if ($errors->has('com_pale'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('com_pale') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="col-xs-3 col-sm-3 col-md-3">
                <div class="form-group">
                        <label>Tripleta </label>
                    <input id="com_tripleta"  type="number" maxlength="2" class="form-control{{ $errors->has('com_tripleta') ? ' is-invalid' : '' }}" name="com_tripleta" value="{{ old('com_tripleta') }}" required>

                    @if ($errors->has('com_tripleta'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('com_tripleta') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
             <div class="col-xs-3 col-sm-3 col-md-3">
                <div class="form-group">
                        <label>SuperPale </label>
                    <input id="com_superpale"  type="number" maxlength="2" class="form-control{{ $errors->has('com_superpale') ? ' is-invalid' : '' }}" name="com_superpale" value="{{ old('com_superpale') }}" required>

                    @if ($errors->has('com_superpale'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('com_superpale') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
        </div>
    </div>
