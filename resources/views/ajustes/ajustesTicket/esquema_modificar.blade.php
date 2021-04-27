<div class="modal-dialog modal-xl" role="document">
        <div class="modal-content border-info">

            <div class="modal-header bg-info">
                <h3 class="modal-title text-white">Modificar Esquema de Ticket</h3>
                <button type="button" class="close text-white no-print" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form method="post" action="{{ route('ajustesTicket.update', $esquema->id)}}"  id="store">
             @csrf {{method_field('PUT')}}
                <div class="modal-body">
                    <div class="option-div-group">
                    <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                <div class="option-div  @if($esquema->eqt_tipo == 'blank') {{'active'}} @endif">
                                    <h5>FORMATO: <br>XXXX <i class="fa fa-check-circle pull-right icon"></i></h5>
                                <input type="radio" name="eqt_tipo" value="blank" @if($esquema->eqt_tipo == 'blank') checked @endif>
                                </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                <div class="option-div  @if($esquema->eqt_tipo == 'year') {{'active'}} @endif">
                                    <h5>FORMATO: <br>{{ date('Y') }}-XXXX <i class="fa fa-check-circle pull-right icon"></i></h5>
                                    <input type="radio" name="eqt_tipo" value="year" @if($esquema->eqt_tipo == 'year') checked @endif>
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
                                <input type="text" class="form-control{{ $errors->has('eqt_nombre') ? ' is-invalid' : '' }}" placeholder="Nombre" id="eqt_nombre" name="eqt_nombre" value="{{ old('eqt_nombre', $esquema->eqt_nombre) }}" >
                            </div>
                        </div>
                    </div>
                    <div id="invoice_format_settings">
                        <div class="row">

                            <div class="col-xs-12 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <strong>Prefijo:</strong>
                                    <input type="text" class="form-control{{ $errors->has('eqt_prefijo') ? ' is-invalid' : '' }}"  id="eqt_prefijo" name="eqt_prefijo" value="{{ old('eqt_prefijo', $esquema->eqt_prefijo) }}" >
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-6">
                                    <div class="form-group">
                                    <strong>Iniciar desde:</strong>
                                    <input type="text" class="form-control{{ $errors->has('eqt_ticket_inicial') ? ' is-invalid' : '' }}" min="0" id="eqt_ticket_inicial" name="eqt_ticket_inicial" value="{{ old('eqt_ticket_inicial', $esquema->eqt_ticket_inicial) }}" >
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <strong>Incremento Ticket:</strong>
                                        <input type="text" class="form-control{{ $errors->has('eqt_ticket_aumento') ? ' is-invalid' : '' }}" min="1" id="eqt_ticket_aumento" name="eqt_ticket_aumento" value="{{ old('eqt_ticket_aumento', $esquema->eqt_ticket_aumento) }}" >
                                    </div>
                                </div>
                            <div class="col-xs-12 col-sm-6 col-md-6">
                            <div class="form-group">
                                    <strong>Numero de Dígitos Ticket:</strong>
                                            <select class="form-control " name="eqt_ticket_digitos" id="eqt_ticket_digitos" required>
                                                @foreach($totalDigitos as $key => $totalDigito)
                                                <option value="{{ $key }}" @if($key == old('eqt_ticket_digitos', $esquema->eqt_ticket_digitos)) selected @endif>{{ $totalDigito }}</option>
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
                                                <option value="{{ $key }}" @if($key == old('eqt_pin_digitos', $esquema->eqt_pin_digitos)) selected @endif>{{ $totalDigito }}</option>
                                                @endforeach
                                        </select>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger no-print"
                        data-dismiss="modal"><i class="fa fa-times"></i> Cerrar
                    </button>
                     <button class="btn btn-success" type="submit"><i class="fa fa-check-square-o"></i> Modificar</button>

                </div>
             </form>
        </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->



