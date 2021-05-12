@extends('layouts.app')
    @section('title', 'Ajustes Comunes')
    @section('content')
        <div class="row pt-2 pb-2">
            <div class="col-sm-9">
                <h4 class="page-title">Ajustes Empresa</h4>
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
                 <div class="row">
                    @include('ajustes.ajustesComunes.partials.form')

                </div>
            </div>
        </div><!--End Row-->

    @endsection
