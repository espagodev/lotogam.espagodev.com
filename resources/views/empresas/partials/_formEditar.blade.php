 <form action="{{ route('empresas.update',$empresa->emp_url) }}" method="post" enctype="multipart/form-data">
    @csrf {{method_field('PUT')}}
            <div class="row">
                <div class="col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                        <div class="col-xs-12 col-sm-4 col-md-4">
                                            <div class="form-group">
                                                <strong>Codigo Empresa:</strong>
                                                <input class="form-control{{ $errors->has('emp_cod') ? ' is-invalid' : '' }}"  type="text" value="{{ old('$emp_cod', $empresa->emp_cod) }}"  readonly>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-8 col-md-8">
                                            <div class="form-group">
                                                <strong>Nombre Empresa:</strong>
                                                <input class="form-control{{ $errors->has('emp_nombre') ? ' is-invalid' : '' }}" name="emp_nombre" id="emp_nombre" type="text" value="{{ old('emp_nombre', $empresa->emp_nombre) }}" required>
                                            </div>
                                        </div>
                                </div>
                                      <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                        <label>Seleccionar Logo</label>
                                            <input type="file" class="mb-3 form-control" id="emp_imagen" name="emp_imagen" >
                                            @if($empresa->emp_imagen)
                                  <p class="help-block">Subir solo si desea Reemplazar la <a href="{{ $empresa->emp_imagen }}" target="_blank">Imagen Actual</a></p>
                                @endif
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <strong>Tipo Documento:</strong>
                                                <select class="form-control" name="tipos_documentos_id" id="tipos_documentos_id" required>
                                                    <option value="">Seleccione</option>
                                                        @foreach($documentos as $documento)
                                                        <option value="{{ $documento->identificador }}" @if($documento->identificador == old('tipos_documentos_id', $empresa->tipos_documentos_id)) selected @endif >{{ $documento->documento }}</option>
                                                        @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <strong>Documento:</strong>
                                                <input class="form-control{{ $errors->has('emp_documento') ? ' is-invalid' : '' }}" name="emp_documento" id="emp_documento" type="text" value="{{ old('emp_documento', $empresa->emp_documento) }}"  required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <strong>Telefono:</strong>
                                                <input class="form-control{{ $errors->has('emp_telefono') ? ' is-invalid' : '' }}" name="emp_telefono" id="emp_telefono" type="text" value="{{ old('emp_telefono', $empresa->emp_telefono) }}" required>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <strong>Movil:</strong>
                                                <input class="form-control{{ $errors->has('emp_movil') ? ' is-invalid' : '' }}" name="emp_movil" id="emp_movil" type="text" value="{{ old('emp_movil', $empresa->emp_movil) }}" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-6 col-md-6">
                                            <div class="form-group">
                                            <strong>Direccion:</strong>
                                            <input class="form-control{{ $errors->has('emp_direccion') ? ' is-invalid' : '' }}" name="emp_direccion" id="emp_direccion" type="text" value="{{ old('emp_direccion', $empresa->emp_direccion) }}" required>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <strong>Codigo Postal: (Opcional)</strong>
                                                <input class="form-control{{ $errors->has('emp_codpostal') ? ' is-invalid' : '' }}" name="emp_codpostal" id="emp_codpostal" type="text" value="{{ old('emp_codpostal', $empresa->emp_codpostal) }}" >
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>
                         <div class="card">
                            <div class="card-body">
                                @include('empresas/_admin')
                            </div>
                        </div>
                       {{-- <div class="card">
                            <div class="card-body">
                                @include('empresas/_plan')
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                @include('empresas/_factura')
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                @include('empresas/_pago')
                            </div>
                        </div> --}}
                        <div class="form-footer">
                            <button type="button" class="btn btn-danger"><i class="fa fa-times"></i> CANCELAR</button>
                            <button type="submit" class="btn btn-success"><i class="fa fa-check-square-o"></i> MODIFICAR</button>
                        </div>
                </div>
                <div class="col-lg-4">
                    <div class="card">
                            <div class="card-body">
                                @include('empresas/partials/_ajustes')
                            </div>
                        </div>
                </div>
            </div><!--End Row-->
</form>
