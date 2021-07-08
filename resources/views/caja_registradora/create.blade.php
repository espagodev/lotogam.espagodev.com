@extends('layouts.app')
@section('title','Abrir Caja Registradora')
    @section('content')
            <div class="row pt-2 pb-2">
                <div class="col-sm-9">
                    <h4 class="page-title">Abrir Caja Registradora</h4>
                </div>
            </div>
             <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('caja-registradora.store') }}" method="post" id="store">
                                @csrf
                                 <div class="row">
                                     <div class="col-sm-2"></div>
                                    <div class="col-sm-7 col-sm-offset-2">
                                         <div class="form-group">
                                            <strong>Dinero en Efectivo:</strong>
                                            <input class="form-control{{ $errors->has('crd_monto') ? ' is-invalid' : '' }}" name="crd_monto" id="crd_monto" type="number" value="{{ old('crd_monto') }}" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-9 col-sm-offset-2">
                                        <button type="submit" class="btn btn-primary pull-right">Abrir Caja Registradora</button>
                                    </div>
                                 </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
    @endsection
