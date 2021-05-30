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
  @yield('head')
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
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
  <nav class="navbar navbar-expand-md navbar-dark navbar2">
    <div class="container-fluid">
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
        </ul>
        
      </div>
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