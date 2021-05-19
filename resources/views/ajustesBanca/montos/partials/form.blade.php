        <div class="col-lg-12">
            <div class="card card-default">
                <div class="card-header d-flex align-items-left">
                    <div class="d-flex justify-content-left col">
                        <div class="h4 m-0 text-left">Montos</div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('bancas.update',$banca->id) }}" method="post">
                        @csrf {{method_field('PUT')}}
                            <div class="row">
                                <div class="col-xs-12 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <strong>Monto Global</strong>:</strong>
                                            <select class="form-control " name="montos_globales_id" id="montos_globales_id" required>
                                                <option value="">Seleccione</option>
                                                    @foreach($montosGlobales as $key => $montoGlobal)
                                                    <option value="{{ $montoGlobal->id }}"  @if($montoGlobal->id == $banca->montos_globales_id) selected @endif>{{ $montoGlobal->mtg_nombre }}</option>
                                                    @endforeach
                                            </select>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-6">
                                    <div class="form-group">
                                    <strong>Monto Individual:</strong>
                                      <select class="form-control " name="montos_individuales_id" id="montos_individuales_id" required>
                                                <option value="">Seleccione</option>
                                                    @foreach($montosIndividuales as $key => $montoIndividual)
                                                    <option value="{{ $montoIndividual->id }}"  @if($montoIndividual->id == $banca->montos_individuales_id) selected @endif>{{ $montoIndividual->mti_nombre }}</option>
                                                    @endforeach
                                            </select>
                                    </div>
                                </div>

                            </div>

                        <div class="form-footer">
                            <button type="submit" class="btn btn-success"><i class="fa fa-check-square-o"></i> MODIFICAR</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


