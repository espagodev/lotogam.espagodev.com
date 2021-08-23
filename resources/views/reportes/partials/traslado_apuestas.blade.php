 <div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-3">
                <div class="form-group">
                     <strong>Loterias:</strong>
                      <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-user"></i></span>
                        </div>
                        <select class="form-control " name="loterias_id" id="loterias_id">
                            <option value="">Seleccione</option>
                            @foreach($loterias as  $loteria)
                                    <option value="{{ $loteria->loterias_id }}"  >{{ $loteria->lot_nombre}}</option>
                                @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-3">
                <div class="form-group">
                     <strong>Bancas:</strong>
                      <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-map-marker"></i></span>
                        </div>
                        <select class="form-control " name="bancas_id" id="bancas_id">
                            <option value="">Seleccione</option>
                                @foreach($bancas as $banca)
                                    <option value="{{ $banca->id }}"  >{{ $banca->ban_nombre}}</option>
                                @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-3">
                <div class="form-group">
                     <strong>Modalidades:</strong>
                      <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-map-marker"></i></span>
                        </div>
                        <select class="form-control " name="modalidades_id" id="modalidades_id">
                            <option value="">Seleccione</option>
                                @foreach($modalidades as $modalida)
                                    <option value="{{ $modalida->identificador }}"  >{{ $modalida->modalidad}}</option>
                                @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-3">
                <div class="form-group">
                    <strong>Rango de Fechas:</strong>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                        </div>
                        <input type="text" name="date_range" id="spr_date_filter" placeholder="Seleccione un rango de fechas" readonly>

                    </div>
                </div>
            </div>
        </div>        
    </div>
 </div>

