@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col">
                <div class="row">
                    <h2 class="display-2">{{ $loteria->lot_nombre }}  ({{ $loteria->lot_abreviado }})</h2>
                </div>
                <div class="row">

                        <div class="col-4">
                            <h5>{{ $loteria->lot_nombre }}</h5>
                             <p>{{ $loteria->lot_codigo}}</p>
                        </div>

                </div>
            </div>
        </div>
    </div>


@endsection
