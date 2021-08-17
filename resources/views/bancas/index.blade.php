@extends('layouts.app')
    @section('content')
     <div class="row pt-2 pb-2">
        <div class="col-sm-9">
		    <h4 class="page-title">Bancas</h4>
	   </div>
        <div class="col-sm-3">
            <div class="btn-group float-sm-right">

                    <a href="{{ route('bancas.create') }}"  class="btn btn-primary waves-effect waves-primary"><i class="fa fa-plus mr-1"></i> Crear Nueva Banca</a>
            </div>
        </div>
     </div>

       @if(!$bancas)
        <div class="row">
            <div class="col-lg-12">
                <div class="card text-center">
                    <div class="card-header">
                        </div>
                    <div class="card-body">
                        <h5 class="card-title">Creación de Bancas</h5>
                        <p class="card-text">Aun no cuenta con bancas creadas.</p>
                         <a href="{{ route('bancas.create') }}"  class="btn btn-primary waves-effect waves-primary"><i class="fa fa-plus mr-1"></i> Crear Nueva Banca</a>
                    </div>
                </div>
            </div>
      </div>
      @else
      <div class="row">

         @foreach($bancas as  $banca)
            <div class="col-lg-3 col-sm-5">
                <div class="card card-default">
                    <div class="card-header"></div>
                    <div class="card-body text-center"><i class="fa fa-desktop fa-4x"></i>
                        <h4>{{ $banca->ban_nombre }}</h4>
                    </div>
                    <div class="card-footer d-flex">
                        <div>
                            {{-- @if($banca->isOnline())
                                <p class="mb-1"><span class="circle bg-success circle-lg text-left"></span>
                            @else
                                <p class="mb-1"><span class="circle bg-danger circle-lg text-left"></span>
                            @endif --}}
                        </div>
                        <div class="ml-auto bt-switch">
                            <a class="btn btn-outline-warning btn-sm" href="{{route('ajustesBanca',$banca->ban_url)}}">Detalle</a>
                             {{-- <input type="checkbox" data-id="{{$banca->id}}" {{ $banca->estado ? 'checked' : '' }} data-size="small" data-on-color="success" data-off-color="default" data-on-text="<i class='fa fa-check-circle-o'></i>" data-off-text="<i class='fa  fa-ban'></i>" > --}}
                        </div>
                    </div>
                </div>
            </div>
         @endforeach
    </div>
      @endif


   @endsection



