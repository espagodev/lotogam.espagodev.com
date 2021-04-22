<div id="wrapper">
    <div id="sidebar-wrapper" data-simplebar="" data-simplebar-auto-hide="true" class="no-print">
        <div class="brand-logo">
        <a href="{{ route('home') }}">
            @if(request()->session()->get('business.logo') == '')
            <img src="{{ asset('images/logo-icon.png') }}" class="logo-icon" alt="logo icon">
            <h5 class="logo-text">{{ config('app.name', 'LotoGam') }}</h5>
        @else
         <img src="{{ request()->session()->get('business.logo') }}" >
        @endif
    </a>
    </div>
    <div class="user-details no-print">
        <div class="media align-items-center user-pointer collapsed" data-toggle="collapse" data-target="#user-dropdown">
        <div class="avatar"><img class="mr-3 side-user-img" src="{{ asset('images/avatars/avatar-13.png') }}" alt="user avatar"></div>
        <div class="media-body">
        <h6 class="side-user-name">{{ Auth::user()->name }}</h6>
        </div>
        </div>
        <div id="user-dropdown" class="collapse">
        <ul class="user-setting-menu">
                <li><a href="javaScript:void();"><i class="icon-user"></i>  My Profile</a></li>
                <li><a href="javaScript:void();"><i class="icon-settings"></i> Setting</a></li>
        <li><a href="{{ route('logout') }}"  onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();"><i class="icon-power"></i> Salir</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
        </ul>
        </div>
        </div>
    <ul class="sidebar-menu no-print">
      <li>
        <a href="{{ route('home') }}" class="waves-effect">
          <i class="fa fa-tachometer"></i> <span>Inicio</span>
        </a>
       </li>
    {{-- @dump( request()->session()->get('user.TipoUsuario')) --}}
    @if(request()->session()->get('user.TipoUsuario') == 2)
       <li>
        <a href="{{ asset('ajustesEmpresa') }}" class="waves-effect">
          <i class="zmdi zmdi-widgets"></i> <span>Ajustes</span>
        </a>
      </li>
       <li>
        <a href="{{ route('bancas.index') }}" class="waves-effect">
          <i class="zmdi zmdi-widgets"></i> <span>Bancas</span>
        </a>
      </li>
      @endif
       @if(request()->session()->get('user.TipoUsuario') == 1)
         <li>
        <a href="{{ route('appConfigEmpresas.index') }}" class="waves-effect">
          <i class="zmdi zmdi-widgets"></i> <span>Configuración</span>
        </a>
      </li>

       <li>
        <a href="{{ route('empresas.index') }}" class="waves-effect">
          <i class="zmdi zmdi-widgets"></i> <span>Empresas</span>
        </a>
      </li>
      @endif
        @if(request()->session()->get('user.TipoUsuario') == 2)
        <li>
            <a href="{{ route('suscripcion.index') }}" class="waves-effect">
            <i class="zmdi zmdi-widgets"></i> <span>Suscripciòn</span>
            </a>
        </li>
        @endif
       @if(request()->session()->get('user.TipoUsuario') == 1)
       <li>
        <a href="{{ route('loterias.index') }}" class="waves-effect">
          <i class="zmdi zmdi-widgets"></i> <span>Loterias</span>
        </a>
      </li>
       <li>
        <a href="{{ route('mediosPago.index') }}" class="waves-effect">
          <i class="zmdi zmdi-widgets"></i> <span>Medios de Pago</span>
        </a>
      </li>
       <li>
        <a href="{{ route('modalidades.index') }}" class="waves-effect">
          <i class="zmdi zmdi-widgets"></i> <span>Modalidades</span>
        </a>
      </li>
       <li>
        <a href="{{ route('planes.index') }}" class="waves-effect">
          <i class="zmdi zmdi-widgets"></i> <span>Planes</span>
        </a>
      </li>
      @endif
       {{-- <li>
        <a href="{{ route('premios.index') }}" class="waves-effect">
          <i class="zmdi zmdi-widgets"></i> <span>Premios</span>
        </a>
      </li> --}}
    @if(request()->session()->get('user.TipoUsuario') != 1)
     <li>
        <a href="javaScript:void();" class="waves-effect">
          <i class="zmdi zmdi-grid"></i> <span>Reportes</span>
          <i class="fa fa-angle-left float-right"></i>
        </a>
        <ul class="sidebar-submenu">
          <li><a href="{{ asset('reportes/reporte-ventas') }}"><i class="zmdi zmdi-dot-circle-alt"></i>Reporte de Ventas</a></li>
          <li><a href="{{ asset('reportes/reporte-premiados') }}"><i class="zmdi zmdi-dot-circle-alt"></i>Reporte de Ganadores</a></li>
          <li><a href="{{ asset('reportes/reporte-resultados') }}"><i class="zmdi zmdi-dot-circle-alt"></i>Resultados Loterias</a></li>
          <li><a href="{{ asset('reportes/reporte-modalidades') }}"><i class="zmdi zmdi-dot-circle-alt"></i>Listado de Numeros</a></li>
          <li><a href="{{ asset('reportes/reporte-tickets') }}"><i class="zmdi zmdi-dot-circle-alt"></i>Reporte de Tickets</a></li>

        </ul>
       </li>

        <li>
        <a href="{{ route('resultados.index') }}" class="waves-effect">
          <i class="zmdi zmdi-widgets"></i> <span>Resultados</span>
        </a>
      </li>
       <li>
        <a href="{{ route('pos.index') }}" class="waves-effect">
          <i class="zmdi zmdi-widgets"></i> <span>Tickets</span>
        </a>
      </li>
       <li>
        <a href="{{ route('controlJugadas.index') }}" class="waves-effect">
          <i class="zmdi zmdi-widgets"></i> <span>Control de Apuestas</span>
        </a>
      </li>
      @endif
    @if(request()->session()->get('user.TipoUsuario') == 2)
       <li>
        <a href="{{ route('usuarios.index') }}" class="waves-effect">
          <i class="zmdi zmdi-widgets"></i> <span>Usuarios</span>
        </a>
      </li>

      @endif
       @if(request()->session()->get('user.TipoUsuario') == 1)
       <li>
        <a href="{{ route('tiposDocumento.index') }}" class="waves-effect">
          <i class="zmdi zmdi-widgets"></i> <span>Tipos de Documento</span>
        </a>
      </li>
      @endif
       <li>
        <a href="{{ asset('printServer/pos_print_server_v1.3.7z') }}" class="waves-effect">
          <i class="fa fa-download"></i> <span>Impresion Pos</span>
        </a>
       </li>
    </ul>
 </div>
