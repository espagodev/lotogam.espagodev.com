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
                <div class="card">
                    <div class="card-body">
                        <ul class="nav nav-tabs nav-tabs-primary top-icon nav-justified">
                <li class="nav-item">
                    <a href="javascript:void();" data-target="#profile" data-toggle="pill" class="nav-link active"><i class="icon-user"></i> <span class="hidden-xs">Detalle</span></a>
                </li>
                <li class="nav-item">
                    <a href="javascript:void();" data-target="#messages" data-toggle="pill" class="nav-link"><i class="icon-envelope-open"></i> <span class="hidden-xs">Facturas</span></a>
                </li>
                <li class="nav-item">
                    <a href="javascript:void();" data-target="#edit" data-toggle="pill" class="nav-link"><i class="icon-note"></i> <span class="hidden-xs">Modificar</span></a>
                </li>
            </ul>
            <div class="tab-content p-3">
                <div class="tab-pane active" id="profile">
                    <div class="row">
                        <div class="col-md-6">
                            <h6>Comisiones</h6>
                        </div>
                        <div class="col-md-6">
                             @foreach($comisiones as $key => $comision)
                                <tr>
                                    <td>{{ $comision->com_valor}} %</td>
                                </tr>
                            @endforeach
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <h6>Montos Globales</h6>
                        </div>
                        <div class="col-md-6">
                             @foreach($montosGlobales as $key => $montoGlobal)
                                <tr>
                                    <td>{{ $montoGlobal->mtg_valor}}</td>
                                </tr>
                            @endforeach
                        </div>

                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <h6>Montos Individuales</h6>
                        </div>
                        <div class="col-md-6">
                              @foreach($montosIndividuales as $key => $montoIndividual)
                                <tr>
                                    <td>{{ $montoIndividual->mti_valor}}</td>
                                </tr>
                                @endforeach
                        </div>

                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <h6>Numeros Calientes</h6>
                        </div>
                        <div class="col-md-6">
                             @foreach($numerosCalientes as $key => $numeroCaliente)
                                <tr>
                                    <td>{{ $numeroCaliente->nuc_numero }}</td>
                                </tr>
                            @endforeach
                        </div>

                    </div>
                    <hr>
                    <!--/row-->
                </div>
                <div class="tab-pane" id="messages">
                    <div class="alert alert-info alert-dismissible" role="alert">
				   <button type="button" class="close" data-dismiss="alert">&times;</button>
				    <div class="alert-icon">
					 <i class="icon-info"></i>
				    </div>
				    <div class="alert-message">
				      <span><strong>Info!</strong> Lorem Ipsum is simply dummy text.</span>
				    </div>
                  </div>
                  <div class="table-responsive">
                    <table class="table table-hover table-striped">
                        <tbody>
                            <tr>
                                <td>
                                   <span class="float-right font-weight-bold">3 hrs ago</span> Here is your a link to the latest summary report from the..
                                </td>
                            </tr>
                            <tr>
                                <td>
                                   <span class="float-right font-weight-bold">Yesterday</span> There has been a request on your account since that was..
                                </td>
                            </tr>
                            <tr>
                                <td>
                                   <span class="float-right font-weight-bold">9/10</span> Porttitor vitae ultrices quis, dapibus id dolor. Morbi venenatis lacinia rhoncus.
                                </td>
                            </tr>
                            <tr>
                                <td>
                                   <span class="float-right font-weight-bold">9/4</span> Vestibulum tincidunt ullamcorper eros eget luctus.
                                </td>
                            </tr>
                            <tr>
                                <td>
                                   <span class="float-right font-weight-bold">9/4</span> Maxamillion ais the fix for tibulum tincidunt ullamcorper eros.
                                </td>
                            </tr>
                        </tbody>
                    </table>
                  </div>
                </div>
                <div class="tab-pane" id="edit">

                     {{-- <form action="{{ route('empresas.update',$empresa->emp_url) }}" method="post" enctype="multipart/form-data">
                        @csrf {{method_field('PUT')}}
                         @include('empresas.partials._formEditar')
                    </form> --}}
                </div>
            </div>
                    </div>
                </div>
            </div>
      </div><!--End Row-->
   @endsection
