@extends('layouts.app')
    @section('content')
     <div class="row pt-2 pb-2">
        <div class="col-sm-9">
		    <h4 class="page-title">Ajustes Empresa</h4>
		{{-- <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javaScript:void();">Bulona</a></li>
            <li class="breadcrumb-item"><a href="javaScript:void();">Pages</a></li>
            <li class="breadcrumb-item active" aria-current="page">Blank Page</li>
        </ol> --}}
	   </div>
        <div class="col-sm-3">
            <div class="btn-group float-sm-right">
                 <button class="btn btn-xs btn-success" type="button" data-toggle="modal" data-target="#nuevo">Crear nuevo Esquema</button>
                {{-- <button type="button" class="btn btn-primary waves-effect waves-primary" data-toggle="modal" data-target="#nuevo"><i class="fa fa-plus mr-1"></i> Nueva Loteria</button> --}}
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

        <div class="row">
             <div class="col-lg-3">
                 @include('ajustes._sidebar')
            </div>
            <div class="col-lg-9">
                 @if(!$ticketEsquemas)
                    <div class="card">
                        <div class="card-body">
                        <h5 class="card-title">Configuración de Tickets</h5>
                        <p class="card-text">Se requiere de una Configuración Inicial.</p>
                        <button class="btn btn-xs btn-success" type="button" data-toggle="modal" data-target="#nuevo">Configuración</button>
                        </div>
                    </div>
                 @else
                    <div class="card">
                    <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Nombre</th>
                                            <th scope="col">Prefijo</th>
                                            <th scope="col">Iniciar desde</th>
                                            <th scope="col">Incremento</th>
                                            <th scope="col">Recuento de Tickets</th>
                                            <th scope="col">Digitos Ticket</th>
                                            <th scope="col">Digitos Pin</th>
                                            <th scope="col">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($ticketEsquemas as $key => $ticketEsquema)
                                        <tr>
                                            <td>{{ $ticketEsquema->eqt_nombre }}</td>
                                            <td>{{ $ticketEsquema->eqt_prefijo }}</td>
                                            <td>{{ $ticketEsquema->eqt_ticket_inicial }}</td>
                                            <td>{{ $ticketEsquema->eqt_ticket_aumento }}</td>
                                            <td>{{ $ticketEsquema->eqt_ultimo_ticket }}</td>
                                            <td>{{ $ticketEsquema->eqt_ticket_digitos }}</td>
                                            <td>{{ $ticketEsquema->eqt_pin_digitos }}</td>
                                            <td>
                                                 <a href="{{route('premios.edit',$ticketEsquema->id)}}" class="btn btn-outline-warning" rel="tooltip" title="Editar Premios" >
                                                        <i class="fa fa-pencil"></i>
                                                    </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                    </div>
                </div>
                 @endif
            </div>
      </div><!--End Row-->
   @endsection

     <div class="modal fade" id="nuevo">
        <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title">Configuración inicial para la Creación de Tickets</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                 <form method="post" action="{{ route('ajustesTicket.store')}}" enctype="multipart/form-data">
                    @include('ajustes.ajustesTicket.form')
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Cancelar</button>
            <button type="submit" class="btn btn-primary"><i class="fa fa-check-square-o"></i> Crear Configuración</button>
            </div>
            </form>
        </div>
        </div>
    </div>

    <div class="modal fade" id="modificar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <h4 class="modal-title" id="myModalLabel">Modificar Configuración para los Tickets</h4><button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('ajustesTicket.update','tickets')}}">
                    <input type="hidden" name="tco_id" id="tco_id"  value="">
                     {{method_field('put')}}
                 @include('ajustes.ajustesTicket.form')
            </div>
            <div class="modal-footer"><button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                <button class="btn btn-primary" type="submit">Guardar Cambios</button></div>
         </div>
          </form>
      </div>
   </div>
