@extends('layouts.app')
@section('title', 'Crear nueva Empresa')
    @section('content')
     <div class="row pt-2 pb-2">
        <div class="col-sm-9">
		    <h4 class="page-title">Nueva Empresa</h4>
	   </div>
        <div class="col-sm-3">
            <div class="btn-group float-sm-right">
                 <a href="{{ route('empresas.index') }}"  class="btn btn-danger waves-effect waves-danger"><i class="fa fa-undo"></i> Regresar</a>
            </div>
        </div>
     </div>
      <form action="{{ route('empresas.store') }}" method="post" enctype="multipart/form-data" id="store">
                    @csrf
        <div class="row">
                <div class="col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                        <div class="col-xs-12 col-sm-4 col-md-4">
                                            <div class="form-group">
                                                <strong>Codigo Empresa:</strong>
                                                <input class="form-control{{ $errors->has('emp_cod') ? ' is-invalid' : '' }}" name="emp_cod" id="emp_cod" type="text" value="{{ $codigoEmpresa }}"  readonly>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-8 col-md-8">
                                            <div class="form-group">
                                                <strong>Nombre Empresa:</strong>
                                                <input class="form-control{{ $errors->has('emp_nombre') ? ' is-invalid' : '' }}" name="emp_nombre" id="emp_nombre" type="text" value="{{ old('emp_nombre') }}" required >
                                                @if ($errors->has('emp_nombre'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('emp_nombre') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                </div>
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                        <label>Seleccionar Logo</label>
                                            <input type="file" class="mb-3 form-control" id="emp_imagen" name="emp_imagen" >
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
                                                <input class="form-control{{ $errors->has('emp_documento') ? ' is-invalid' : '' }}" name="emp_documento" id="emp_documento" type="text" value="{{ old('emp_documento') }}"  required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <strong>Telefono:</strong>
                                                <input class="form-control{{ $errors->has('emp_telefono') ? ' is-invalid' : '' }}" name="emp_telefono" id="emp_telefono" type="text" value="{{ old('emp_telefono') }}" required>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <strong>Movil:</strong>
                                                <input class="form-control{{ $errors->has('emp_movil') ? ' is-invalid' : '' }}" name="emp_movil" id="emp_movil" type="text" value="{{ old('emp_movil') }}" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-6 col-md-6">
                                            <div class="form-group">
                                            <strong>Direccion:</strong>
                                            <input class="form-control{{ $errors->has('emp_direccion') ? ' is-invalid' : '' }}" name="emp_direccion" id="emp_direccion" type="text" value="{{ old('emp_direccion') }}" required>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <strong>Codigo Postal: (Opcional)</strong>
                                                <input class="form-control{{ $errors->has('emp_codpostal') ? ' is-invalid' : '' }}" name="emp_codpostal" id="emp_codpostal" type="text" value="{{ old('emp_codpostal') }}" >
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                {{-- @include('empresas/_admin') --}}
                            </div>
                        </div>
                        <div class="card">
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
                        </div>
                        <div class="form-footer">
                            <a href="{{ route('empresas.index') }}"  class="btn btn-danger waves-effect waves-danger"><i class="fa fa-undo"></i> Cancelar</a>
                            <button type="submit" class="btn btn-success"><i class="fa fa-check-square-o"></i> CREAR</button>
                        </div>
                </div>
                <div class="col-lg-4">
                    <div class="card">
                            <div class="card-body">
                                @include('empresas/_ajustes')
                            </div>
                        </div>
                </div>
      </div><!--End Row-->
      </form>
   @endsection

@section('scripts')
<script src="{{ asset('js/empresa/empresa.js') }}"></script>


 <script>
        $('.datepicker-startdate').datepicker();
         $(document).ready(function(){

            loteria.subscription();
     });
    </script>
@endsection
