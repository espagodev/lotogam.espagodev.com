@extends('layouts.app')
    @section('content')
     <div class="row pt-2 pb-2">
        <div class="col-sm-9">
		    <h4 class="page-title">usuarios</h4>
		{{-- <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javaScript:void();">Bulona</a></li>
            <li class="breadcrumb-item"><a href="javaScript:void();">Pages</a></li>
            <li class="breadcrumb-item active" aria-current="page">Blank Page</li>
        </ol> --}}
	   </div>
        <div class="col-sm-3">
            <div class="btn-group float-sm-right">

                    <a href="{{ route('usuarios.create') }}"  class="btn btn-primary waves-effect waves-primary"><i class="fa fa-plus mr-1"></i> Crear Nuevo usuario</a>

                {{-- <button type="button" class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target="#nuevo"><i class="fa fa-plus m-1"></i> Nuevo Resultado</button> --}}
                {{-- <button type="button" class="btn btn-light dropdown-toggle dropdown-toggle-split waves-effect waves-light" data-toggle="dropdown">
                <span class="caret"></span>
                </button>
                <div class="dropdown-menu">
                <a href="javaScript:void();" class="dropdown-item">Action</a>
                <a href="javaScript:void();" class="dropdown-item">Another action</a>
                <a href="javaScript:void();" class="dropdown-item">Something else here</a>
                <div class="dropdown-divider"></div>
                <a href="javaScript:void();" class="dropdown-item">Separated link</a>
                </div> --}}
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
                    <div class="card-header"></div>

                    <div class="card-body text-center "><i class="fa fa-user-circle-o fa-4x" style="color: green;"></i>
                        <h4>{{ $usuario->name }}</h4>
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
                            <a class="btn btn-outline-warning btn-sm" href="{{route('usuarios.edit',$usuario->id)}}">Modificar</a>
                             {{-- <input type="checkbox" data-id="{{$usuario->id}}" {{ $usuario->estado ? 'checked' : '' }} data-size="small" data-on-color="success" data-off-color="default" data-on-text="<i class='fa fa-check-circle-o'></i>" data-off-text="<i class='fa  fa-ban'></i>" > --}}
                        </div>
                    </div>
                </div>
            </div>
         @endforeach
    </div>
      @endif


   @endsection



