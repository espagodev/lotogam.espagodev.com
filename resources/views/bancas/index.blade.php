@extends('layouts.app')
@section('title', 'Listado de Bancas')
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
                    <div class="card-body text-center"><i class="fa fa-desktop fa-3x"></i>
                        <h5>{{ $banca->ban_nombre }}</h5>
                        <a class="btn btn-outline-warning btn-sm" href="{{route('ajustesBanca',$banca->ban_url)}}" title="Modficar"><i class="fa fa-edit" aria-hidden="true"></i></a>
                        <a class="btn btn-outline-success btn-sm duplicar-banca" href="#" data-href="{{action('BancasController@duplicarBanca', [$banca->ban_url])}}" title="Duplicar"><i class="fa fa-clone" aria-hidden="true"></i></a>
                        <a class="btn btn-outline-info btn-sm" href="{{action('BancaLoteriasController@loterias', [$banca->id])}}" title="Loterias"><i class="fa fa-tag" aria-hidden="true"></i></a>
                        <a class="btn btn-outline-info btn-sm" href="{{action('BancaLoteriasController@loteriasSuper', [$banca->id])}}" title="Loterias Super"><i class="fa fa-tags" aria-hidden="true"></i></a>
                    </div>
                    <div class="card-footer d-flex">
                        <div class="ml-auto bt-switch">
                             {{-- <input type="checkbox" data-id="{{$banca->id}}" {{ $banca->estado ? 'checked' : '' }} data-size="small" data-on-color="success" data-off-color="default" data-on-text="<i class='fa fa-check-circle-o'></i>" data-off-text="<i class='fa  fa-ban'></i>" > --}}
                        </div>
                    </div>
                </div>
            </div>
         @endforeach
    </div>
      @endif
      <div class="modal fade nuevo_modal" tabindex="-1" role="dialog"
      aria-labelledby="gridSystemModalLabel">
  </div>
   @endsection
    @section('scripts')
        <script src="{{ asset('js/banca.js?v=' . $asset_v) }}"></script>
    @endsection


