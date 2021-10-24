@extends('layouts.app')
@section('title', 'Nuevo Movimiento')
@section('content')
    <div class="row pt-2 pb-2">
        <div class="col-sm-9">
            <h4 class="page-title">Nuevo Movimiento de Caja</h4>
        </div>
        <div class="col-sm-3">
            <div class="btn-group float-sm-right">
                <a href="{{ route('cuadre-caja.index') }}" class="btn btn-danger waves-effect waves-danger"><i
                        class="fa fa-times mr-1"></i> Regresar</a>
            </div>
        </div>
    </div>
    <form method="post" action="{{ route('cuadre-caja.store') }}" id="store">
        @csrf
        @include('caja_general.partials.form')

        <div class="form-footer">
            <a href="{{ route('bancas.index') }}" class="btn btn-danger waves-effect waves-danger"><i
                    class="fa fa-times"></i> cancelar</a>
            <button type="submit" class="btn btn-success"><i class="fa fa-check-square-o"></i> CREAR</button>
        </div>
    </form>
@endsection
@section('scripts')

    <script src="{{ asset('js/select.js?v=' . $asset_v) }}"></script>

@endsection
