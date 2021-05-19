        <div class="col-lg-12">
            <div class="card card-default">
                <div class="card-header d-flex align-items-left">
                    <div class="d-flex justify-content-left col">
                        <div class="h4 m-0 text-left">Comision</div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('bancas.update',$banca->id) }}" method="post">
                        @csrf {{method_field('PUT')}}
                            <div class="row">
                                <div class="col-xs-12 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <strong>Comision</strong>:</strong>
                                            <select class="form-control " name="comisiones_id" id="comisiones_id" required>
                                                <option value="">Seleccione</option>
                                                    @foreach($comisiones as $key => $comision)
                                                    <option value="{{ $comision->id }}"  @if($comision->id == $banca->comisiones_id) selected @endif>{{ $comision->com_nombre }}</option>
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
