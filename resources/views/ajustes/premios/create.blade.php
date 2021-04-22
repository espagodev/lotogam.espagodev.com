@extends('layouts.app')
    @section('content')
         <div class="row pt-2 pb-2">
        <div class="col-sm-9">
		    <h4 class="page-title">Ajustes Empresa / Crear lista de Premios</h4>
	   </div>
        <div class="col-sm-3">
            <div class="btn-group float-sm-right">

            </div>
        </div>
     </div>

        <div class="row">
             <div class="col-lg-3">
                 @include('ajustes._sidebar')
            </div>
            <div class="col-lg-9">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Crear Premios</h5>
                            <form action="{{ route('premios.store')}}" method="post" id="store">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row">
                                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                                            <div class="form-group">
                                                                <strong>Nombre:</strong>
                                                                <input class="form-control{{ $errors->has('pre_nombre') ? ' is-invalid' : '' }}" name="pre_nombre" id="pre_nombre" type="text" value="{{ old('pre_nombre') }}" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">Quiniela</h5>
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <label >Premio 1°</label>
                                                                <input type="text" class="form-control{{ $errors->has('pre_valor_1') ? ' is-invalid' : '' }}" placeholder="0" name="quiniela[quiniela][pre_valor_1]" value="{{ old('pre_valor_1') }}" required>
                                                                    @if ($errors->has('pre_valor_1'))
                                                                        <span class="invalid-feedback">
                                                                        <strong>{{ $errors->first('pre_valor_1') }}</strong>
                                                                        </span>
                                                                    @endif
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <label >Premio 2°</label>
                                                                <input type="text" class="form-control{{ $errors->has('pre_valor_2') ? ' is-invalid' : '' }}" placeholder="0" name="quiniela[quiniela][pre_valor_2]" value="{{ old('pre_valor_2') }}" required>
                                                                    @if ($errors->has('pre_valor_2'))
                                                                        <span class="invalid-feedback">
                                                                            <strong>{{ $errors->first('pre_valor_2') }}</strong>
                                                                        </span>
                                                                    @endif
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <label >Premio 3°</label>
                                                                <input type="text" class="form-control{{ $errors->has('pre_valor_3') ? ' is-invalid' : '' }}" placeholder="0" name="quiniela[quiniela][pre_valor_3]" value="{{ old('pre_valor_3') }}" required>
                                                                    @if ($errors->has('pre_valor_3'))
                                                                        <span class="invalid-feedback">
                                                                            <strong>{{ $errors->first('pre_valor_3') }}</strong>
                                                                        </span>
                                                                    @endif
                                                        </div>
                                                    </div>
                                                </div>
                                        </div>
                                         <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">Pale</h5>
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <label >Premio 1°</label>
                                                                <input type="text" class="form-control{{ $errors->has('pre_valor_1') ? ' is-invalid' : '' }}" placeholder="0" name="pale[pale][pre_valor_1]" value="{{ old('pre_valor_1') }}" required>
                                                                    @if ($errors->has('pre_valor_1'))
                                                                        <span class="invalid-feedback">
                                                                        <strong>{{ $errors->first('pre_valor_1') }}</strong>
                                                                        </span>
                                                                    @endif
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <label >Premio 2°</label>
                                                                <input type="text" class="form-control{{ $errors->has('pre_valor_2') ? ' is-invalid' : '' }}" placeholder="0" name="pale[pale][pre_valor_2]" value="{{ old('pre_valor_2') }}" required>
                                                                    @if ($errors->has('pre_valor_2'))
                                                                        <span class="invalid-feedback">
                                                                            <strong>{{ $errors->first('pre_valor_2') }}</strong>
                                                                        </span>
                                                                    @endif
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <label >Premio 3°</label>
                                                                <input type="text" class="form-control{{ $errors->has('pre_valor_3') ? ' is-invalid' : '' }}" placeholder="0" name="pale[pale][pre_valor_3]" value="{{ old('pre_valor_3') }}" required>
                                                                    @if ($errors->has('pre_valor_3'))
                                                                        <span class="invalid-feedback">
                                                                            <strong>{{ $errors->first('pre_valor_3') }}</strong>
                                                                        </span>
                                                                    @endif
                                                        </div>
                                                    </div>
                                                </div>
                                        </div>
                                         <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">Tripleta</h5>
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <label >Premio 1°</label>
                                                                <input type="text" class="form-control{{ $errors->has('pre_valor_1') ? ' is-invalid' : '' }}" placeholder="0" name="tripleta[tripleta][pre_valor_1]" value="{{ old('pre_valor_1') }}" required>
                                                                    @if ($errors->has('pre_valor_1'))
                                                                        <span class="invalid-feedback">
                                                                        <strong>{{ $errors->first('pre_valor_1') }}</strong>
                                                                        </span>
                                                                    @endif
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <label >Premio 2°</label>
                                                                <input type="text" class="form-control{{ $errors->has('pre_valor_2') ? ' is-invalid' : '' }}" placeholder="0" name="tripleta[tripleta][pre_valor_2]" value="{{ old('pre_valor_2') }}" required>
                                                                    @if ($errors->has('pre_valor_2'))
                                                                        <span class="invalid-feedback">
                                                                            <strong>{{ $errors->first('pre_valor_2') }}</strong>
                                                                        </span>
                                                                    @endif
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <label >Premio 3°</label>
                                                                <input type="text" class="form-control{{ $errors->has('pre_valor_3') ? ' is-invalid' : '' }}" placeholder="0" name="tripleta[tripleta][pre_valor_3]" value="{{ old('pre_valor_3') }}" required>
                                                                    @if ($errors->has('pre_valor_3'))
                                                                        <span class="invalid-feedback">
                                                                            <strong>{{ $errors->first('pre_valor_3') }}</strong>
                                                                        </span>
                                                                    @endif
                                                        </div>
                                                    </div>
                                                </div>
                                        </div>
                                         <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">SuperPale</h5>
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <label >Premio 1°</label>
                                                                <input type="text" class="form-control{{ $errors->has('pre_valor_1') ? ' is-invalid' : '' }}" placeholder="0" name="superpale[superpale][pre_valor_1]" value="{{ old('pre_valor_1') }}" required>
                                                                    @if ($errors->has('pre_valor_1'))
                                                                        <span class="invalid-feedback">
                                                                        <strong>{{ $errors->first('pre_valor_1') }}</strong>
                                                                        </span>
                                                                    @endif
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <label >Premio 2°</label>
                                                                <input type="text" class="form-control{{ $errors->has('pre_valor_2') ? ' is-invalid' : '' }}" placeholder="0" name="superpale[superpale][pre_valor_2]" value="{{ old('pre_valor_2') }}" required>
                                                                    @if ($errors->has('pre_valor_2'))
                                                                        <span class="invalid-feedback">
                                                                            <strong>{{ $errors->first('pre_valor_2') }}</strong>
                                                                        </span>
                                                                    @endif
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <label >Premio 3°</label>
                                                                <input type="text" class="form-control{{ $errors->has('pre_valor_3') ? ' is-invalid' : '' }}" placeholder="0" name="superpale[superpale][pre_valor_3]" value="{{ old('pre_valor_3') }}" required>
                                                                    @if ($errors->has('pre_valor_3'))
                                                                        <span class="invalid-feedback">
                                                                            <strong>{{ $errors->first('pre_valor_3') }}</strong>
                                                                        </span>
                                                                    @endif
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
                    </div>
                </div>
            </div>
      </div><!--End Row-->
    @endsection
