@extends('layouts.app')
    @section('content')
        <div class="row pt-2 pb-2">
        <div class="col-sm-9">
		    <h4 class="page-title">Suscripción</h4>
	   </div>
        <div class="col-sm-3">
            <div class="btn-group float-sm-right">

                    {{-- <a href="{{ route('usuarios.create') }}"  class="btn btn-primary waves-effect waves-primary"><i class="fa fa-plus mr-1"></i> Crear Nuev0 usuario</a> --}}
            </div>
        </div>
     </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="row pt-2 pb-2">
                                <div class="col-sm-12">
                                    <h4 class="page-title">Suscripción activa</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
         <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="row pt-2 pb-2">
                                <div class="col-sm-12">
                                    <h4 class="page-title">Todas las Suscripciones </h4>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Nombre Plan</th>
                                            <th scope="col">Fecha de Inicio</th>
                                            <th scope="col">Fecha Final</th>
                                            <th scope="col">Precio</th>
                                            <th scope="col">Forma de Pago</th>
                                            <th scope="col">Estado</th>
                                            <th scope="col">Creado en</th>
                                            <th scope="col">Solicitado por</th>
                                            <th scope="col">Accion</th>
                                        </tr>

                                    </thead>
                                    <tbody>
                                         {{-- @foreach($mediosPago as $key => $medioPago)
                                        <tr>
                                            <td>{{ $medioPago->abreviado}}</td>
                                            <td>{{ $medioPago->medioPago}}</td>
                                             <td  class="card-body bt-switch">
                                                <input type="checkbox" data-id="{{$medioPago->identificador}}"  data-size="small" data-on-color="success" data-off-color="default" data-on-text="<i class='fa fa-check-circle-o'></i>" data-off-text="<i class='fa  fa-ban'></i>" {{ $medioPago->estado ? 'checked' : '' }}>
                                            </td>
                                            <td>
                                                <a href="" class="btn btn-outline-warning" rel="tooltip" title="Editar modalidad" >
                                                    <i class="fa fa-pencil"></i>
                                                </a>

                                            </td>
                                        </tr>
                                        @endforeach --}}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
         <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row pt-2 pb-2">
                                <div class="col-sm-12">
                                    <h4 class="page-title">Planes</h4>
                                </div>
                            </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="pricing-table">
                                    <div class="card">
                                    <div class="card-body text-center">
                                    <div class="price-title">PERSONAL</div>
                                    <h2 class="price"><small class="currency">$</small>199</h2>
                                    <ul class="list-group list-group-flush">
                                    <li class="list-group-item"><b>4 GB</b> Ram</li>
                                    <li class="list-group-item"><b>80 GB</b> Disk Space</li>
                                    <li class="list-group-item">Monthly Backups</li>
                                    <li class="list-group-item">Email Support</li>
                                    <li class="list-group-item">24X7 Support</li>
                                    </ul>
                                    <a href="javascript:void();" class="btn btn-primary my-3 btn-round">View More</a>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
