@extends('layouts.app')
@section('title', 'Diseños de Tickets')
    @section('content')
     <div class="row pt-2 pb-2">
        <div class="col-sm-9">
		    <h4 class="page-title">Ajustes Empresa / Diseños de Tickets</h4>
	   </div>
        <div class="col-sm-3">
            <div class="btn-group float-sm-right">
                 <a href="{{ route('formatoTicket.create') }}"  class="btn btn-primary waves-effect waves-primary"><i class="fa fa-plus mr-1"></i> Crear Nuevo diseño</a>
            </div>
        </div>
     </div>

        <div class="row">
             <div class="col-lg-3">
                 @include('ajustes._sidebar')
            </div>
            <div class="col-lg-9">
                    @if(!$ticketConfiguracion)
                    <div class="card">
                        <div class="card-body">
                        <h5 class="card-title">Diseño de Tickets</h5>
                        <p class="card-text">Se requiere de un Diseño Inicial.</p>
                        <a href="{{ route('formatoTicket.create') }}"  class="btn btn-primary waves-effect waves-primary"><i class="fa fa-plus mr-1"></i> Crear Nuevo diseño</a>
                        </div>
                    </div>
                 @else


                    <div class="row">
                        @foreach($ticketConfiguracion as $layout)
                            <div class="col-lg-3 col-sm-6">
                                <div class="card card-default">
                                    <div class="card-header"></div>
                                    <div class="card-body text-center"><i class="fa fa-file-text-o fa-4x"></i>
                                        <h4>{{ $layout->tcon_nombre }}</h4>
                                    </div>
                                    <div class="card-footer d-flex">
                                        <div>
                                            {{-- @if($usuario->isOnline())
                                                <p class="mb-1"><span class="circle bg-success circle-lg text-left"></span>
                                            @else
                                                <p class="mb-1"><span class="circle bg-danger circle-lg text-left"></span>
                                            @endif --}}
                                        </div>
                                        <div class="ml-auto bt-switch">
                                            <a class="btn btn-outline-warning btn-sm" href="{{route('formatoTicket.edit',$layout->id)}}">Detalle</a>
                                            {{-- @if($layout->locations->count())
                                    <span class="link-des">
                                    <b>@lang('invoice.used_in_locations'): </b><br>
                                    @foreach($layout->locations as $location)
                                        {{ $location->name }}
                                        @if (!$loop->last)
                                            ,
                                        @endif
                                        &nbsp;
                                    @endforeach
                                    </span>
                                @endif --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>


                    @endif
            </div>
      </div><!--End Row-->
   @endsection
