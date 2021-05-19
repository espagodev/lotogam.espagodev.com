@extends('layouts.app')
@section('title', 'Comision')
    @section('content')
     <div class="row pt-2 pb-2">
        <div class="col-sm-9">
		    <h4 class="page-title"><i class="fa fa-desktop"></i> Ajustes Banca Comisiones / {{ $banca->ban_nombre }}</h4>
	   </div>
        <div class="col-sm-3">
            @include('ajustesBanca.partials.regresar')
        </div>
     </div>

        <div class="row">

             <div class="col-lg-4">
                 @include('ajustesBanca._sidebar')
            </div>
                <div class="col-lg-8">
                    {{-- @dump($comisionesBancas) --}}
                    @include('ajustesBanca.comisiones.partials.form')

                    </div>

                </div>

      </div><!--End Row-->
    @endsection
