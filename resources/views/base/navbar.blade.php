<nav class="navbar navbar-expand-md navbar2" id="navbar">
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      
      <ul class="navbar-nav nav-underline nav-underline-primary me-auto">
        <li class="nav-item">
          <a class="nav-link {{ request()->is('Bienvenido') ? 'active' : '' }}" href="{{route('bienvenido')}}">Home</a>
        </li>
        @if(session()->has('Visualizar unidad'))
        <li class="nav-item">
          <a class="nav-link {{ (request()->is('unidades') || request()->is('unidades/*')) ? 'active' : '' }}" 
          href="{{route('unidades.lista')}}">Unidades</a>
        </li>
        @endif
        @if(session()->has('Visualizar usuario'))
        <li class="nav-item">
          <a class="nav-link {{ (request()->is('usuario') || request()->is('usuario/*')) ? 'active' : '' }}" 
          href="{{route('usuario.index')}}">Usuarios</a>
        </li>
        @endif
        @if(session()->has('Visualizar item de gasto'))
        <li class="nav-item">
          <a class="nav-link {{ (request()->is('itemsgastos') || request()->is('itemsgastos/*')) ? 'active' : '' }}" 
          href="{{route('itemsgastos.index')}}">Items de gasto</a>
        </li>
        @endif
        @if(session()->has('Visualizar rol'))
        <li class="nav-item">
          <a class="nav-link {{ (request()->is('roles') || request()->is('roles/*')) ? 'active' : '' }}" 
          href="{{route('roles.index')}}">Roles de usuario</a>
        </li>
        @endif
        @if(session()->has('Visualizar solicitud de items'))
        <li class="nav-item">
          <a class="nav-link {{ (request()->is('solicitudes-de-items') || request()->is('solicitudes-de-items/*')) ? 'active' : '' }}" 
          href="{{route('solicitudes-de-items.index')}}">Solicitudes de items</a>
        </li>
        @endif
        @if(session()->has('Visualizar solicitud de adquisicion'))
        <li class="nav-item">
          <a class="nav-link {{ (request()->is('lista') || request()->is('lista/*')) ? 'active' : '' }}" 
          href="{{route('lista.index')}}">Solicitudes de adquisicion</a>
        </li>
        @endif
        @if(session()->has('Visualizar solicitud de cotizacion'))
        <li class="nav-item">
          <a class="nav-link {{ (request()->is('solicitudCotizacion') || request()->is('solicitudCotizacion/*')) || (request()->is('comparativo') || request()->is('comparativo/*')) ? 'active' : '' }}" 
          href="{{route('solicitudCotizacion.index')}}">Solicitudes de cotizacion</a>
        </li>
        @endif
        <li class="nav-item">
          <a class="nav-link {{ (request()->is('ListaEmpresas') || request()->is('ListaEmpresas/*')) ? 'active' : '' }}" 
          href="{{route('empresa.index')}}">Empresas</a>
        </li>
      </ul>       
    </div>

  </div>
</nav>