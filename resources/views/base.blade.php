<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title')</title>
  <link rel="shortcut icon" href="favicon.ico">
  <link rel="stylesheet" href="{{ asset('css/base.css') }}">
  <link rel="stylesheet" href="{{ asset('css/base2.css') }}">
  @yield('head')
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
</head>
<body class="c-dark-theme">
  
  <nav class="navbar navbar-expand-lg navbar-dark navbar1">
    <div class="container-fluid">
      <a class="navbar-brand" href="{{route('bienvenido')}}">CotySoft</a>
      <div class="d-flex justify-content-end">
        @include('base.utilities')
      </div>
    </div>
  </nav>
  <nav class="navbar navbar-expand-lg navbar-dark navbar2">
    <div class="container-fluid">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link {{ request()->is('Bienvenido') ? 'active' : '' }}" href="{{route('bienvenido')}}">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ (request()->is('unidades') || request()->is('unidades/registro')) ? 'active' : '' }}" href="{{route('unidades.lista')}}">Unidades</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ (request()->is('usuario') || request()->is('usuario/create')) ? 'active' : '' }}" href="{{route('usuario.index')}}">Usuarios</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ (request()->is('itemsgastos') || request()->is('itemsgastos/create')) ? 'active' : '' }}" href="{{route('itemsgastos.index')}}">Items de gasto</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ (request()->is('roles') || request()->is('roles/create')) ? 'active' : '' }}" href="{{route('roles.index')}}">Roles de usuario</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ (request()->is('solicitudes-de-items') || request()->is('solicitudes-de-items/create')) ? 'active' : '' }}" href="{{route('solicitudes-de-items.index')}}">Solicitudes de items</a>
          </li>
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

</body>
</html>