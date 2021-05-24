@extends('layouts.app')
@section('title', 'Planes')
    @section('content')
     <div class="row pt-2 pb-2">
        <div class="col-sm-9">
		    <h4 class="page-title">Planes de Afiliación</h4>
	   </div>
        <div class="col-sm-3">
            <div class="btn-group float-sm-right">
                 <a href="{{ route('planes.create') }}"  class="btn btn-primary waves-effect waves-primary"><i class="fa fa-plus mr-1"></i> Crear Nuevo Plan</a>

            </div>
        </div>
     </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Cod</th>
                                            <th scope="col">Plan</th>
                                            <th scope="col">Valor</th>
                                            <th scope="col">Tiempo(Meses)</th>
                                            <th scope="col">Estado</th>
                                            <th scope="col">Opciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($planes as $key => $plan)
                                        <tr>
                                           <td>{{ $plan->codigo}}</td>
                                            <td>{{ $plan->plan}}</td>
                                            <td>{{ $plan->planValor}}</td>
                                            <td>{{ $plan->planTiempo}}</td>
                                            <td  class="bt-switch">
                                                <input type="checkbox" data-id="{{$plan->identificador}}" {{ $plan->estado ? 'checked' : '' }} data-size="small" data-on-color="success" data-off-color="default" data-on-text="<i class='fa fa-check-circle-o'></i>" data-off-text="<i class='fa  fa-ban'></i>" >
                                            </td>
                                            <td>
                                               <a href="{{route('planes.edit',$plan->identificador)}}" class="btn btn-outline-warning" rel="tooltip" title="Editar Plan" >
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
            </div>
      </div><!--End Row-->
   @endsection
