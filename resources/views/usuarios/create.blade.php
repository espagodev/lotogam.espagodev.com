@extends('layouts.app')
@section('title', 'Crear Nuevo Usuario')
    @section('content')
         <div class="row pt-2 pb-2">
        <div class="col-sm-9">
		    <h4 class="page-title">Nuevo Usuario</h4>

	   </div>
        <div class="col-sm-3">
            <div class="btn-group float-sm-right">
                 <a href="{{ route('usuarios.index') }}"  class="btn btn-danger waves-effect waves-danger"><i class="fa fa-undo mr-1"></i> Cancelar</a>
            </div>
        </div>
     </div>
        <form action="{{ route('usuarios.store') }}" method="post" id="store">
            @csrf
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <strong>Nombre:</strong>
                                            <input class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" id="name" type="text" value="{{ old('name') }}" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <strong>Nickname:</strong>
                                            <input class="form-control{{ $errors->has('use_nickname') ? ' is-invalid' : '' }}" name="use_nickname" id="use_nickname" type="text" value="{{ old('use_nickname') }}" >
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <strong>Tipo Documento:</strong>
                                            <select class="form-control" name="tipos_documentos_id" id="tipos_documentos_id" required>
                                                <option value="">Seleccione</option>
                                                    @foreach($documentos as $documento)
                                                    <option value="{{ $documento->identificador }}" @if($documento->identificador == old('tipos_documentos_id')) selected @endif >{{ $documento->documento }}</option>
                                                    @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <strong>Documento:</strong>
                                            <input class="form-control{{ $errors->has('use_documento') ? ' is-invalid' : '' }}" name="use_documento" id="use_documento" type="text" value="{{ old('use_documento') }}" required>
                                        </div>
                                    </div>
                                </div>

                        </div>
                    </div>
                    <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <strong>Telefono:</strong>
                                            <input class="form-control{{ $errors->has('use_telefono') ? ' is-invalid' : '' }}" name="use_telefono" id="use_telefono" type="text" value="{{ old('use_telefono') }}" required>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <strong>Movil:</strong>
                                            <input class="form-control{{ $errors->has('use_movil') ? ' is-invalid' : '' }}" name="use_movil" id="use_movil" type="text" value="{{ old('use_movil') }}" >
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <strong>Direccion:</strong>
                                            <input class="form-control{{ $errors->has('use_direccion') ? ' is-invalid' : '' }}" name="use_direccion" id="use_direccion" type="text" value="{{ old('use_direccion') }}" required>

                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <strong>Codigo Postal: (Opcional)</strong>
                                            <input class="form-control{{ $errors->has('use_codpostal') ? ' is-invalid' : '' }}" name="use_codpostal" id="use_codpostal" type="text" value="{{ old('use_codpostal') }}" >
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <strong>Email:</strong>
                                                <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" id="email" type="text" value="{{ old('email') }}" required>
                                                <p>Este es el correo electrónico utilizado para iniciar sesión, y  donde recibirá sus recordatorios.</p>
                                            </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <strong>Password:</strong>
                                            {{-- <input class="form-control{{ $errors->has('emp_usuarios') ? ' is-invalid' : '' }}" name="emp_usuarios" id="emp_usuarios" type="text" value="{{ old('emp_usuarios') }}" > --}}
                                            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required autocomplete="new-password">
                                        </div>
                                    </div>

                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <strong>Confirmar Password:</strong>
                                                {{-- <input class="form-control{{ $errors->has('password-confirm') ? ' is-invalid' : '' }}" name="password-confirm" id="password-confirm" type="text" value="{{ old('password-confirm') }}" > --}}
                                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                            </div>
                                    </div>
                                </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <strong>Bancas:</strong>
                                        <select class="form-control" name="bancas_id" id="bancas_id" required>
                                            <option value="">Seleccione</option>
                                                @foreach($bancas as $banca)
                                                <option value="{{ $banca->id }}" @if($banca->id == old('tipos_banca_id')) selected @endif >{{ $banca->ban_nombre }}</option>
                                                @endforeach
                                        </select>
                                    </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <strong>Horario:</strong>
                                    <select class="form-control" name="use_horario" id="use_horario" required>
                                        <option value="">Seleccione</option>
                                            @foreach($horarios as $key => $horario)
                                            <option value="{{ $key }}" >{{ $horario }}</option>
                                            @endforeach
                                    </select>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="row">
                             <div class="col-xs-12 col-sm-3 col-md-3">
                                <div class="form-group">
                                    <div class="icheck-material-info">
                                        <input type="checkbox" id="use_resultados" name="use_resultados" value="1"/>
                                        <label for="use_resultados">Ingresa Resultados.</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-3 col-md-3">
                                <div class="form-group">
                                    <div class="icheck-material-info">
                                        <input type="checkbox" id="use_bloquea_banca" name="use_bloquea_banca" value="1"/>
                                        <label for="use_bloquea_banca">Bloquear Banca.</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-3 col-md-3">
                                <div class="form-group">
                                    <div class="icheck-material-info">
                                        <input type="checkbox" id="use_supervisor" name="use_supervisor" value="1"/>
                                        <label for="use_supervisor">Usuario Supervisor.</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-3 col-md-3">
                                <div class="form-group">
                                    <div class="icheck-material-info">
                                        <input type="checkbox" id="use_cuadre_caja" name="use_cuadre_caja" value="1"/>
                                        <label for="use_cuadre_caja">Permite Cuadre de Caja.</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                 <div class="form-footer">
                              <a href="{{ route('usuarios.index') }}"  class="btn btn-danger waves-effect waves-danger"><i class="fa fa-times mr-1"></i> Cancelar</a>
                            <button type="submit" class="btn btn-success"><i class="fa fa-check-square-o"></i> CREAR</button>
                        </div>
            </div>
        </form>
    @endsection