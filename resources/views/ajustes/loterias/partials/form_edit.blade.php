    <div>
        <div class="row">
            <div class="col-lg-3">
                    <div class="card">
                        <img src="{{$loteria->lot_imagen}}" class="card-img-top" >
                    </div>
                    <div class="card">
                    <div class="card-body">
                        <div class="row">
                                <div class="col-lg-6">
                                    <h6>Loteria</h6>
                                    <p>{{ ($loteria->lot_nombre )}}</p>
                            </div>
                                <div class="col-lg-6">
                                    <h6>Abreviado</h6>
                                <p>{{ ($loteria->lot_abreviado )}}</p></div>
                        </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <h6>Codigo</h6>
                                    <p>{{ ($loteria->lot_codigo )}}</p></div>
                                <div class="col-lg-6">
                                    <h6>Estado</h6>
                                <p>{{ ($loteria->lot_estado )}}</p></div>
                        </div>
                            <div class="row">
                                    <div class="col-lg-12"> <h6>Horario del Sorteo </h6></div>
                        </div>
                            <div class="row">
                                <div class="col-lg-6">
                                <input type="hidden" class="Horariols"  id="Horariols_L" value="{{($sorteos['l-s'] )}}"/>
                                <h6>Lunes - Sabado</h6><p>{{ ($sorteos['l-s'] )}}</p></div>
                                <div class="col-lg-6">
                                    <input type="hidden" class="Horariod" id="Horariod_{{$loteria->id}}_D" value="{{($sorteos['d'] )}}"/>
                                <h6>Domingo</h6><p>{{ ($sorteos['d'] )}}</p></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-9">

                    <div class="card card-default">
                        <div class="card-header d-flex align-items-left">
                        <div class="d-flex justify-content-left col">
                        <div class="h4 m-0 text-left">Horario Loteria - {{ ($loteria->lot_nombre )}}</div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-sm-2">Día</div>
                            <div class="col-sm-1">Activo</div>
                            <div class="col-sm-3">Inicio de Venta</div>
                            <div class="col-sm-3">Horario Cierre</div>
                            {{-- <div class="col-sm-2">Minutos a cerrar antes del sorteo</div> --}}
                        </div>
                        @foreach($horarios as $key => $horario)
                            {{-- @dump($dias, $key+1, $horario) --}}
                            <div class="form-group row">
                                <div class="col-sm-2">{{ $dias[$key+1]}}</div>
                                <div class="col-sm-1"><input type="checkbox" name="hlo_activo[]" value="{{ $key+1  }}" @if($horario->hlo_activo) checked @endif></div>
                                <div class="col-sm-3"> <input name="hlo_hora_inicio[{{ $key+1  }}]" id="hlo_hora_inicio_{{ $key+1 }}"  type="text" value="{{ $horario->hlo_hora_inicio }}" class="form-control input-small hlo_hora_inicio"></div>
                                <div class="col-sm-3"><input name="hlo_hora_fin[{{ $key+1  }}]" id="hlo_hora_fin_L_{{ $key+1 }}"  type="text" class="form-control input-small hlo_hora_fin" value="{{ $horario->hlo_hora_fin }}" ></div>
                                {{-- <div class="col-sm-2"><input name="hlo_minutos[{{ $key+1  }}]" rel="{{ $key+1 }}" id="hlo_minutos_{{ $key+1 }}" type="number" min="0" value="{{ $horario->hlo_minutos }}" class="form-control input-small updateTime" ></div> --}}
                            </div>
                        @endforeach
                    </div>

                    </div>                    
            </div>
        </div><!--End Row-->
    </div>
