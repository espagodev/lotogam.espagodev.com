
    @csrf
    <!-- descripcion -->
    <div class="resultados">
        <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group res_fecha">
                        <label>Fecha</label>
                    <input id="res_fecha"  type="text"  class="form-control{{ $errors->has('res_fecha') ? ' is-invalid' : '' }}" name="res_fecha" value="" required>

                    @if ($errors->has('res_fecha'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('res_fecha') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="col-xs-6 col-sm-6 col-md-6 loterias_id">
                <div class="form-group loterias-id">
                        <label>Loterias </label>
                        <select class="form-control{{ $errors->has('loterias_id') ? ' is-invalid' : '' }} validar" name="loterias_id" id="loterias_id" required>
                                <option value="">Seleccione</option>
                                @foreach($loterias as $key => $loteria)
                                    <option value="{{ $loteria->loterias_id }}" data-hora="{{ $loteria->hlo_hora_fin }}" @if($loteria->id == old('loterias_id')) selected @endif >{{ $loteria->lot_nombre }} </option>
                                @endforeach
                        </select>
                </div>
            </div>
        </div>
        <div class="row numerosPremiados">
            <div class="col-xs-4 col-sm-4 col-md-4 ">
                <div class="form-group">
                        <label>1° Lugar </label>
                    <input onkeyup="fn_saltar(this,1);" id="res_premio1" type="number" maxlength="2" class="form-control{{ $errors->has('res_premio1') ? ' is-invalid' : '' }}" name="res_premio1" value="{{ old('res_premio1') }}"required >

                    @if ($errors->has('res_premio1'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('res_premio1') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="col-xs-4 col-sm-4 col-md-4">
                <div class="form-group">
                        <label>2° Lugar </label>
                    <input onkeyup="fn_saltar(this,2);" id="res_premio2" type="number" maxlength="2" class="form-control{{ $errors->has('res_premio2') ? ' is-invalid' : '' }}" name="res_premio2" value="{{ old('res_premio2') }}" required>

                    @if ($errors->has('res_premio2'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('res_premio2') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="col-xs-4 col-sm-4 col-md-4">
                <div class="form-group">
                        <label>3° Lugar </label>
                    <input id="res_premio3"  type="number" maxlength="2" class="form-control{{ $errors->has('res_premio3') ? ' is-invalid' : '' }}" name="res_premio3" value="{{ old('res_premio3') }}" required>

                    @if ($errors->has('res_premio3'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('res_premio3') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="enproceso">
       <div id="loader-overlay" class="visible incoming">
           <div class="loader-wrapper-outer">
               <div class="loader-wrapper-inner" >
                   <div class="loader">
                       </div>
                    </div>
                </div>
            </div>
    </div>
    <div class="procesado">
        <div class="row">
            <div class="text-center">
                Se encontraron  <label class="totalPremiados"></label> Tickets Premiados
            </div>
        </div>
    </div>
