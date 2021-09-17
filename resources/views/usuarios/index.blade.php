@extends('layouts.app')
@section('title', 'Listado Usuarios')
    @section('content')
     <div class="row pt-2 pb-2">
        <div class="col-sm-9">
		    <h4 class="page-title">usuarios</h4>
	   </div>
        <div class="col-sm-3">
            <div class="btn-group float-sm-right">

                    <a href="{{ route('usuarios.create') }}"  class="btn btn-primary waves-effect waves-primary"><i class="fa fa-plus mr-1"></i> Crear Nuevo usuario</a>

            </div>
        </div>
     </div>

       @if(!$usuarios)
        <div class="row">
            <div class="col-lg-12">
                <div class="card text-center">
                    <div class="card-header">
                        </div>
                    <div class="card-body">
                        <h5 class="card-title">Creación de Usuarios</h5>
                        <p class="card-text">Aun no cuenta con Usuarios creados.</p>
                        <button class="btn btn-xs btn-success" type="button" data-toggle="modal" data-target="#empresas">Crear Nuevo Usuario</button>
                    </div>
                </div>
            </div>
      </div>
      @else
      <div class="row">

         @foreach($usuarios as $usuario)
            <div class="col-lg-3 col-sm-5">
                <div class="card card-default">
                    <div class="card-header">
                        @if( $usuario->use_supervisor == 1 )
                        <a href="#" data-href="{{action('UsuariosController@getBancasSuperVisor',$usuario->id) }}"  class="btn btn-outline-primary nuevo-modal" rel="tooltip" title="Asignar Bancas" ><i class="fa fa-address-book-o" aria-hidden="true"></i> </a>                           
                        @endif
                        <a class="btn btn-outline-warning " href="{{route('usuarios.edit',$usuario->id)}}" title="Modificar" ><i class="fa fa-edit" aria-hidden="true"></i></a>
                    </div>

                    <div class="card-body text-center "><i class="fa fa-user-circle-o fa-3x" style="color: green;"></i>
                        <h5>{{ $usuario->name }}</h5>
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
                            <a class="btn btn-outline-info btn-sm" href="{{action('UserLoteriasController@loterias', [$usuario->id])}}">Loterias</a>
                            <a class="btn btn-outline-info btn-sm" href="{{action('UserLoteriasController@loteriasSuper', [$usuario->id])}}">Loterias Super</a>
                             {{-- <input type="checkbox" data-id="{{$usuario->id}}" {{ $usuario->estado ? 'checked' : '' }} data-size="small" data-on-color="success" data-off-color="default" data-on-text="<i class='fa fa-check-circle-o'></i>" data-off-text="<i class='fa  fa-ban'></i>" > --}}
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
   <script src="{{ asset('js/usuarios.js?v=' . $asset_v) }}"></script>
  @endsection


