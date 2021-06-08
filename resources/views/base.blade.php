<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CotySoft</title>
  <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
  <link rel="stylesheet" href="{{ asset('css/base.css') }}">
  <link rel="stylesheet" href="{{ asset('css/base2.css') }}">
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
  <script src="{{ asset('js/bundle.min.js') }}"></script>
  <script src="{{ asset('js/main.js') }}"></script>
  @yield('head')

</head>
<body class="c-dark-theme" id="app">
  
  <nav class="navbar navbar-expand-md navbar-dark navbar1">
    <div class="container-fluid">
      <a class="navbar-brand" href="{{route('bienvenido')}}">CotySoft</a>
      <div class="d-flex justify-content-end">
        @include('base.utilities')
      </div>
    </div>
  </nav>
  <nav class="navbar navbar-expand-md navbar-dark navbar2" id="navbar2">
    <div class="container-fluid">
      <svg class="c-icon mfe-2" onclick="goBack()">
        <use xlink:href="{{asset('img/icons/chevron-circle-left.svg#i-chevron-circle-left')}}"></use>
      </svg>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
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
            <a class="nav-link {{ (request()->is('solicitudCotizacion') || request()->is('solicitudCotizacion/*')) ? 'active' : '' }}" 
            href="{{route('solicitudCotizacion.index')}}">Solicitudes de cotizacion</a>
          </li>
          @endif
        </ul>       
      </div>

      <svg class="c-icon mfe-2" onclick="goNext()">
        <use xlink:href="{{asset('img/icons/chevron-circle-right.svg#i-chevron-circle-right')}}"></use>
      </svg>
    </div>
  </nav>
  @include('base.sidebarSecondary')
  
  <div class="main">
    @yield('main')
  </div>
  
  @yield('scripts')

  <script src="{{ asset('js/bundle.min.js') }}"></script>
  <script src="{{ asset('js/base.js') }}"></script>

</body>
</html>