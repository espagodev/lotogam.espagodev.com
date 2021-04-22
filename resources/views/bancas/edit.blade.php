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
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-xs-12 col-sm-4 col-md-4">
                                    <div class="form-group">
                                        <strong>Codigo Banca:</strong>
                                        <input class="form-control{{ $errors->has('ban_cod') ? ' is-invalid' : '' }}" name="ban_cod" id="ban_cod" type="text" value="{{ old('ban_cod') }}" >
                                    </div>
                                </div>
                                    <div class="col-xs-12 col-sm-8 col-md-8">
                                    <div class="form-group">
                                        <strong>Nombre Banca:</strong>
                                        <input class="form-control{{ $errors->has('ban_nombre') ? ' is-invalid' : '' }}" name="ban_nombre" id="ban_nombre" type="text" value="{{ old('ban_nombre') }}" >
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
                                            <input class="form-control{{ $errors->has('ban_telefono') ? ' is-invalid' : '' }}" name="ban_telefono" id="ban_telefono" type="text" value="{{ old('ban_telefono') }}" >
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <strong>Movil:</strong>
                                            <input class="form-control{{ $errors->has('ban_movil') ? ' is-invalid' : '' }}" name="ban_movil" id="ban_movil" type="text" value="{{ old('ban_movil') }}" >
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <strong>Direccion:</strong>
                                            <input class="form-control{{ $errors->has('ban_direccion') ? ' is-invalid' : '' }}" name="ban_direccion" id="ban_direccion" type="text" value="{{ old('ban_direccion') }}" >

                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <strong>Codigo Postal: (Opcional)</strong>
                                            <input class="form-control{{ $errors->has('ban_codpostal') ? ' is-invalid' : '' }}" name="ban_codpostal" id="ban_codpostal" type="text" value="{{ old('ban_codpostal') }}" >
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
                                            <strong>Email:</strong>
                                            <input class="form-control{{ $errors->has('ban_correo') ? ' is-invalid' : '' }}" name="ban_correo" id="ban_correo" type="text" value="{{ old('ban_correo') }}" >

                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <strong>Pagina Web</strong>
                                            <input class="form-control{{ $errors->has('ban_website') ? ' is-invalid' : '' }}" name="ban_website" id="ban_website" type="text" value="{{ old('ban_website') }}" >
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
            <div class="col-lg-4">
                 @include('bancas/_ajustes')

            </div>
        </form>
    @endsection
