@extends('layouts.app')
    @section('content')
     <div class="row pt-2 pb-2">
        <div class="col-sm-9">
		    <h4 class="page-title">Configuración Empresa/Facturación</h4>
		{{-- <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javaScript:void();">Bulona</a></li>
            <li class="breadcrumb-item"><a href="javaScript:void();">Pages</a></li>
            <li class="breadcrumb-item active" aria-current="page">Blank Page</li>
        </ol> --}}
	   </div>
        <div class="col-sm-3">
            <div class="btn-group float-sm-right">

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
 @if(empty($appConfigEmpresas))
        <div class="row">
            <div class="col-lg-12">
                <div class="card text-center">
                    <div class="card-header">
                        </div>
                    <div class="card-body">
                        <h5 class="card-title">Configuración de Empresas</h5>
                        <p class="card-text">Se requiere de una Configuración Inicial Para crear Empresas.</p>
                        <button class="btn btn-xs btn-success" type="button" data-toggle="modal" data-target="#empresas">Crear Configuración</button>
                    </div>
                </div>
            </div>
      </div>
      @else
      <div class="row">
            <div class="col-lg-12">
                <div class="card text-center">
                    <div class="card-header">
                        Configuración Empresas
                        </div>
                                <div class="card-body">
                            <div class="row m-0 row-group text-center  border-light-3">
                                <div class="col-12 col-lg-12">
                                    <div class="p-3">
                                    <h5 class="mb-0">{{ $appConfigEmpresas->appNombre }}</h5>
                                    <small class="mb-0">Nombre Empresa <span> </small>
                                    </div>
                                </div>

                                </div>
                            <div class="row m-0 row-group text-center border-top border-light-3">
                                <div class="col-12 col-lg-3">
                                    <div class="p-3">
                                    <h5 class="mb-0">{{ $appConfigEmpresas->appDireccion }}</h5>
                                    <small class="mb-0">Dirección <span> </small>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-3">
                                    <div class="p-3">
                                    <h5 class="mb-0">{{ $appConfigEmpresas->appCodigoPostal }}</h5>
                                    <small class="mb-0">Codigo Postal<span> </small>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-3">
                                    <div class="p-3">
                                    <h5 class="mb-0">{{ $appConfigEmpresas->appTelefono }}</h5>
                                    <small class="mb-0">Teléfono <span> </small>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-3">
                                    <div class="p-3">
                                    <h5 class="mb-0">{{ $appConfigEmpresas->appMovil }}</h5>
                                    <small class="mb-0">Movil <span> </small>
                                    </div>
                                </div>
                                </div>
                            <div class="row m-0 row-group text-center border-top border-light-3">
                            <div class="col-12 col-lg-3">
                                <div class="p-3">
                                <h5 class="mb-0">{{ $appConfigEmpresas->prefijoEmpresa }}</h5>
                                <small class="mb-0">Prefijo de Empresa <span> </small>
                                </div>
                            </div>
                            <div class="col-12 col-lg-4">
                                <div class="p-3">
                                <h5 class="mb-0">{{ $appConfigEmpresas->empresaInicial }}</h5>
                                <small class="mb-0">Codigo Empresa <span> </small>
                                </div>
                            </div>
                            <div class="col-12 col-lg-4">
                                <div class="p-3">
                                <h5 class="mb-0">{{ $appConfigEmpresas->dijitosEmpresa }}</h5>
                                <small class="mb-0">Digitos para Codificación <span> </small>
                                </div>
                            </div>
                            </div>
                        </div>
                </div>
            </div>
      </div>
      @endif
      @if(empty($appConfigFacturas))
      <div class="row">
            <div class="col-lg-12">
                <div class="card text-center">
                    <div class="card-header">
                        </div>
                    <div class="card-body">
                        <h5 class="card-title">Configuración de Facturación</h5>
                        <p class="card-text">Se requiere de una Configuración Inicial Para Generar facturas.</p>
                        <button class="btn btn-xs btn-success" type="button" data-toggle="modal" data-target="#facturas">Crear Configuración</button>
                    </div>
                </div>
            </div>
      </div>
      @else
           <div class="row">
            <div class="col-lg-12">
                <div class="card text-center">
                    <div class="card-header">
                        Configuración Facturas
                        </div>
                    <div class="card-body">
                        <div class="row m-0 row-group text-center  border-light-3">
                        <div class="col-12 col-lg-6">
                            <div class="p-3">
                            <h5 class="mb-0">{{ $appConfigFacturas->inicioContable }}</h5>
                            <small class="mb-0">Inicio Periodo Contable <span> </small>
                            </div>
                        </div>
                            <div class="col-12 col-lg-6">
                            <div class="p-3">
                            <h5 class="mb-0">{{ $appConfigFacturas->finContable }}</h5>
                            <small class="mb-0">Fin Periodo Contable <span> </small>
                            </div>
                        </div>
                        </div>
                        <div class="row m-0 row-group text-center border-top border-light-3">
                        <div class="col-12 col-lg-2">
                            <div class="p-3">
                            <h5 class="mb-0">{{ $appConfigFacturas->prefijoFactura }}</h5>
                            <small class="mb-0">Prefijo de Facturación <span> </small>
                            </div>
                        </div>
                        <div class="col-12 col-lg-2">
                            <div class="p-3">
                            <h5 class="mb-0">{{ $appConfigFacturas->facturaInicial }}</h5>
                            <small class="mb-0">Numero De factura <span> </small>
                            </div>
                        </div>
                        <div class="col-12 col-lg-2">
                            <div class="p-3">
                            <h5 class="mb-0">{{ $appConfigFacturas->dijitosFactura }}</h5>
                            <small class="mb-0">Digitos para Facturación<span> </small>
                            </div>
                        </div>
                        <div class="col-12 col-lg-2">
                            <div class="p-3">
                            <h5 class="mb-0">{{ $appConfigFacturas->impuestos }}</h5>
                            <small class="mb-0">Impuestos <span> </small>
                            </div>
                        </div>
                        <div class="col-12 col-lg-2">
                            <div class="p-3">
                            <h5 class="mb-0">{{ $appConfigFacturas->descuentos }}</h5>
                            <small class="mb-0">Descuentos <span> </small>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
      </div>
         @endif

         @endsection
 @section('styles')
        <link href="{{ asset('assets/plugins/inputtags/css/bootstrap-tagsinput.css') }}" rel="stylesheet" />
      <link href="{{ asset('assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css">
     @endsection
   @section('scripts')
   <script src="{{ asset('assets/plugins/inputtags/js/bootstrap-tagsinput.js') }}"></script>
  <script src="{{ asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
  <script>
  $('#cff_inicio_contable').datepicker({
        autoclose: true,
        todayHighlight: true
    });
      $('#cff_fin_contable').datepicker({
        autoclose: true,
        todayHighlight: true
    });

  </script>
   @endsection

    <div class="modal fade" id="empresas">
        <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title">Configuración inicial para la Creación de Empresas</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                 <form method="post" action="{{ route('appConfigEmpresas.store')}}"  autocomplete="off">
                    @include('appConfigEmpresas.form')
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Cancelar</button>
            <button type="submit" class="btn btn-primary"><i class="fa fa-check-square-o"></i> Crear Configuración</button>
            </div>
            </form>
        </div>
        </div>
    </div>
    <div class="modal fade" id="facturas">
        <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title">Configuración inicial para la Generación de Facturas</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                 <form method="post" action="{{ route('appConfigFacturas.store')}}"  autocomplete="off">
                    @include('appConfigFacturas.form')
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Cancelar</button>
            <button type="submit" class="btn btn-primary"><i class="fa fa-check-square-o"></i> Crear Configuración</button>
            </div>
            </form>
        </div>
        </div>
    </div>
