<div class="c-sidebar c-sidebar-dark c-sidebar-fixed" id="sidebar">
  <div class="c-sidebar-brand d-md-down-none" style="padding: .5rem 0;">
    <span class="c-sidebar-brand-full" width="118" height="46" alt="CoreUI Logo">
      <a class="navbar-brand" href="{{route('bienvenido')}}">CotySoft</a>
    </span>
    <span class="c-sidebar-brand-minimized" width="46" height="46" alt="CoreUI Logo">
      <a class="navbar-brand" href="{{route('bienvenido')}}">CS</a>
    </span>
  </div>
  <ul class="c-sidebar-nav ps ps--active-y">
    <li class="c-sidebar-nav-item">
      <a class="c-sidebar-nav-link {{ request()->is('Bienvenido') ? 'c-active' : '' }}" href="{{route('bienvenido')}}">Home</a>
    </li>
    <li class="c-sidebar-nav-title">Menu</li>
    @if(session()->has('Visualizar unidad'))
    <li class="c-sidebar-nav-item">
      <a class="c-sidebar-nav-link {{ (request()->is('unidades') || request()->is('unidades/*')) ? 'c-active' : '' }}" 
      href="{{route('unidades.lista')}}">Unidades</a>
    </li>
    @endif
    @if(session()->has('Visualizar usuario'))
    <li class="c-sidebar-nav-item">
      <a class="c-sidebar-nav-link {{ (request()->is('usuario') || request()->is('usuario/*')) ? 'c-active' : '' }}" 
      href="{{route('usuario.index')}}">Usuarios</a>
    </li>
    @endif
    @if(session()->has('Visualizar item de gasto'))
    <li class="c-sidebar-nav-item">
      <a class="c-sidebar-nav-link {{ (request()->is('itemsgastos') || request()->is('itemsgastos/*')) ? 'c-active' : '' }}" 
      href="{{route('itemsgastos.index')}}">Items de gasto</a>
    </li>
    @endif
    @if(session()->has('Visualizar rol'))
    <li class="c-sidebar-nav-item">
      <a class="c-sidebar-nav-link {{ (request()->is('roles') || request()->is('roles/*')) ? 'c-active' : '' }}" 
      href="{{route('roles.index')}}">Roles de usuario</a>
    </li>
    @endif
    @if(session()->has('Visualizar empresa'))
    <li class="c-sidebar-nav-item">
      <a class="c-sidebar-nav-link {{ (request()->is('ListaEmpresas') || request()->is('ListaEmpresas/*')) ? 'c-active' : '' }}" 
      href="{{route('empresa.index')}}">Empresas</a>
    </li>
    @endif
    @if(session('rol') == 'Superusuario')
    <li class="c-sidebar-nav-title">Actividades</li>
    <li class="c-sidebar-nav-item">
      <a class="c-sidebar-nav-link {{ (request()->is('bitacora') || request()->is('bitacora/*')) ? 'c-active' : '' }}" 
      href="{{route('bitacora.index')}}">Bitacora</a>
    </li>
    <li class="c-sidebar-nav-item">
      <a class="c-sidebar-nav-link {{ (request()->is('presupuestos') || request()->is('presupuestos/*')) ? 'c-active' : '' }}" 
      href="{{route('presupuestos.index')}}">Historial de Presupuestos</a>
    </li>
    @endif
    <li class="c-sidebar-nav-title">Solicitudes</li>
    @if(session()->has('Visualizar solicitud de items'))
    <li class="c-sidebar-nav-item">
      <a class="c-sidebar-nav-link {{ (request()->is('solicitudes-de-items') || request()->is('solicitudes-de-items/*')) ? 'c-active' : '' }}" 
      href="{{route('solicitudes-de-items.index')}}">Solicitudes de items</a>
    </li>
    @endif
    @if(session()->has('Visualizar solicitud de adquisicion'))
    <li class="c-sidebar-nav-item">
      <a class="c-sidebar-nav-link {{ (request()->is('lista') || request()->is('lista/*')) ? 'c-active' : '' }}" 
      href="{{route('lista.index')}}">Solicitudes de adquisicion</a>
    </li>
    @endif
    @if(session()->has('Visualizar solicitud de cotizacion'))
    <li class="c-sidebar-nav-item">
      <a class="c-sidebar-nav-link {{ (request()->is('solicitudCotizacion') || request()->is('solicitudCotizacion/*')) || (request()->is('comparativo') || request()->is('comparativo/*')) || (request()->is('respuestasCotizacion') || request()->is('respuestasCotizacion/*')) ? 'c-active' : '' }}" 
      href="{{route('solicitudCotizacion.index')}}">Solicitudes de cotizacion</a>
    </li>
    @endif
  </ul>
  <div class="c-sidebar-minimizer"></div>
</div>