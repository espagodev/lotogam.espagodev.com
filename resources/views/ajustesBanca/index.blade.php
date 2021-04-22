@extends('layouts.app')
    @section('content')
     <div class="row pt-2 pb-2">
        <div class="col-sm-9">
		    <h4 class="page-title"><i class="fa fa-desktop"></i> Ajustes Banca / {{ $banca->ban_nombre }} </h4>
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
                <div class="card">
                    <div class="card-body">
                        <ul class="nav nav-tabs nav-tabs-primary top-icon nav-justified">
                <li class="nav-item">
                    <a href="javascript:void();" data-target="#profile" data-toggle="pill" class="nav-link active"><i class="fa fa-desktop"></i> <span class="hidden-xs">Perfil</span></a>
                </li>
                <li class="nav-item">
                    <a href="javascript:void();" data-target="#edit" data-toggle="pill" class="nav-link"><i class="icon-note"></i> <span class="hidden-xs">Modificar</span></a>
                </li>
            </ul>
            <div class="tab-content p-3">
                <div class="tab-pane active" id="profile">
                    <h5 class="mb-3">Banca Perfil</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <h6>Dirección</h6>
                            <p>
                                Web Designer, UI/UX Engineer
                            </p>
                            <h6>Usuario</h6>
                            <p>
                                Indie music, skiing and hiking. I love the great outdoors.
                            </p>
                        </div>
                        <div class="col-md-6">
                            <h6>Loterias</h6>
                            <a href="javascript:void();" class="badge badge-dark badge-pill">html5</a>
                            <a href="javascript:void();" class="badge badge-dark badge-pill">react</a>
                            <a href="javascript:void();" class="badge badge-dark badge-pill">codeply</a>
                            <a href="javascript:void();" class="badge badge-dark badge-pill">angularjs</a>
                            <a href="javascript:void();" class="badge badge-dark badge-pill">css3</a>
                            <a href="javascript:void();" class="badge badge-dark badge-pill">jquery</a>
                            <a href="javascript:void();" class="badge badge-dark badge-pill">bootstrap</a>
                            <a href="javascript:void();" class="badge badge-dark badge-pill">responsive-design</a>
                            <hr>
                            <span class="badge badge-primary"><i class="fa fa-user"></i> 900 Followers</span>
                            <span class="badge badge-success"><i class="fa fa-cog"></i> 43 Forks</span>
                            <span class="badge badge-danger"><i class="fa fa-eye"></i> 245 Views</span>
                        </div>
                        <div class="col-md-12">
                            <h5 class="mt-2 mb-3"><span class="fa fa-clock-o ion-clock float-right"></span> Detalle de Configuración</h5>
                             <div class="table-responsive">
                            <table class="table table-hover table-striped">
                                <tbody>
                                    <tr>
                                        <td>
                                            <strong>Comisiones</strong> joined ACME Project Team in <strong>`Collaboration`</strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong>Montos Globales</strong> deleted My Board1 in <strong>`Discussions`</strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong>Montos individuales</strong> deleted MyBoard3 in <strong>`Discussions`</strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong>Modalidades</strong> deleted My Board1 in <strong>`Discussions`</strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong>Impresora</strong> deleted his post Look at Why this is.. in <strong>`Discussions`</strong>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                          </div>
                        </div>
                    </div>
                    <!--/row-->
                </div>

                <div class="tab-pane" id="edit">
                    {{-- @dump($banca); --}}
                   {{-- @include('bancas.partials._formEditar') --}}
                </div>
            </div>
                    </div>
                </div>
            </div>
      </div><!--End Row-->
   @endsection
