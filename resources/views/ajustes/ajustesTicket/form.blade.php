@csrf
<div class="option-div-group">
    <div class="row">
          <div class="col-sm-4">
            <div class="form-group">
              <div class="option-div">
                <h5>FORMATO: <br>XXXX <i class="fa fa-check-circle pull-right icon"></i></h5>
               <input type="radio" name="scheme_type" value="blank">
              </div>
            </div>
          </div>
          <div class="col-sm-4">
            <div class="form-group">
              <div class="option-div">
                <h5>FORMATO: <br>{{ date('Y') }}-XXXX <i class="fa fa-check-circle pull-right icon"></i></h5>
                <input type="radio" name="scheme_type" value="year">
              </div>
            </div>
          </div>
        <div class="col-sm-4">
          <div class="form-group">
            <label>Formato Ticket:</label>
            <div id="preview_format">No Seleccionado</div>
          </div>
        </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Nombre:</strong>
                <input type="text" class="form-control{{ $errors->has('eqt_nombre') ? ' is-invalid' : '' }}" placeholder="Nombre" id="eqt_nombre" name="eqt_nombre" value="{{ old('eqt_nombre') }}" >
            </div>
        </div>
    </div>
     <div id="invoice_format_settings" class="hide">
        <div class="row">

            <div class="col-xs-12 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Prefijo:</strong>
                    <input type="text" class="form-control{{ $errors->has('eqt_prefijo') ? ' is-invalid' : '' }}"  id="prefix" name="eqt_prefijo" value="{{ old('eqt_prefijo') }}" >
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="form-group">
                    <strong>Iniciar desde:</strong>
                    <input type="text" class="form-control{{ $errors->has('eqt_ticket_inicial') ? ' is-invalid' : '' }}" min="0" id="start_number" name="eqt_ticket_inicial" value="1" >
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="form-group">
                        <strong>Incremento Ticket:</strong>
                        <input type="text" class="form-control{{ $errors->has('eqt_ticket_aumento') ? ' is-invalid' : '' }}" min="1" id="eqt_ticket_aumento" name="eqt_ticket_aumento" value="1" >
                    </div>
                </div>
            <div class="col-xs-12 col-sm-6 col-md-6">
            <div class="form-group">
                    <strong>Numero de Dígitos Ticket:</strong>
                            <select class="form-control " name="eqt_ticket_digitos" id="total_digits" required>
                                @foreach($totalDigitos as $key => $totalDigito)
                                <option value="{{ $key }}">{{ $totalDigito }}</option>
                                @endforeach
                        </select>
                </div>
            </div>

        </div>
        <div class="row">

            <div class="col-xs-12 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Numero de Dígitos Pin:</strong>
                            <select class="form-control " name="eqt_pin_digitos" id="eqt_pin_digitos" required>
                                @foreach($totalDigitos as $key => $totalDigito)
                                <option value="{{ $key }}">{{ $totalDigito }}</option>
                                @endforeach
                        </select>
                </div>
            </div>
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="form-group">
                        <div class="icheck-material-info">
                            <input type="checkbox" id="eqt_default" value="" name="eqt_default"checked/>
                            <label for="eqt_default">Establecer por Defecto</label>
                        </div>
                    </div>
                </div>
        </div>
     </div>



