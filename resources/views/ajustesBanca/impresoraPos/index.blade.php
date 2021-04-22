@extends('layouts.app')
    @section('title', 'Ajustes de Impresiòn Pos')
    @section('content')
     <div class="row pt-2 pb-2">
        <div class="col-sm-9">
		    <h4 class="page-title"><i class="fa fa-desktop"></i> Ajustes de Impresiòn Pos / {{ $banca->ban_nombre }}</h4>
	   </div>
        <div class="col-sm-3">
           @include('ajustesBanca.partials.regresar')
        </div>
     </div>

        <div class="row">
             <div class="col-lg-3">
                 @include('ajustesBanca._sidebar')
            </div>
            <div class="col-lg-9">
                <div class="row">
                    @include('ajustesBanca.impresoraPos.partials.form')

                </div>
            </div>
      </div><!--End Row-->

   @endsection
