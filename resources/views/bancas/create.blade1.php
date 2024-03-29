@extends('layouts.app')
    @section('content')
         <div class="row pt-2 pb-2">
        <div class="col-sm-9">
		    <h4 class="page-title">Nueva Banca</h4>

	   </div>
        <div class="col-sm-3">
            <div class="btn-group float-sm-right">
                 <a href="{{ route('bancas.index') }}"  class="btn btn-danger waves-effect waves-danger"><i class="fa fa-plus mr-1"></i> Regresar</a>
            </div>
        </div>
     </div>
        <form action="{{ route('bancas.store') }}" method="post">
            @csrf
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <strong>Nombre:</strong>
                                            <input class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" id="name" type="text" value="{{ old('name') }}" >
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
                                            <select class="form-control" name="tipos_documento_id" id="tipos_documento_id" required>
                                                <option value="">Seleccione</option>
                                                    @foreach($documentos as $documento)
                                                    <option value="{{ $documento->identificador }}" @if($documento->identificador == old('tipos_documento_id')) selected @endif >{{ $documento->documento }}</option>
                                                    @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <strong>Documento:</strong>
                                            <input class="form-control{{ $errors->has('use_documento') ? ' is-invalid' : '' }}" name="use_documento" id="use_documento" type="text" value="{{ old('use_documento') }}" >
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
                                            <input class="form-control{{ $errors->has('use_telefono') ? ' is-invalid' : '' }}" name="use_telefono" id="use_telefono" type="text" value="{{ old('use_telefono') }}" >
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
                                            <input class="form-control{{ $errors->has('use_direccion') ? ' is-invalid' : '' }}" name="use_direccion" id="use_direccion" type="text" value="{{ old('use_direccion') }}" >

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
                                                <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" id="email" type="text" value="{{ old('email') }}" >
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
                 <div class="form-footer">
                            <button type="submit" class="btn btn-danger"><i class="fa fa-times"></i> CANCELAR</button>
                            <button type="submit" class="btn btn-success"><i class="fa fa-check-square-o"></i> CREAR</button>
                        </div>
            </div>
        </form>
    @endsection
