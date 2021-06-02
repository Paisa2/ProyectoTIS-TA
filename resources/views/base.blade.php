<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CotySoft</title>
  <link rel="shortcut icon" href="favicon.ico">
  <link rel="stylesheet" href="{{ asset('css/base.css') }}">
  <link rel="stylesheet" href="{{ asset('css/base2.css') }}">
  @yield('head')
  <script src="{{ asset('js/bundle.min.js') }}"></script>
  <script src="{{ asset('js/main.js') }}"></script>
  
</head>
<body>

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark navbar1">
    <div class="container-fluid">
      <a class="navbar-brand" href="{{route('bienvenido')}}">CotySoft</a>
      <div class="d-flex justify-content-end">
        <div class="dropdown c-dark-theme">
          <span class="text-white" id="btn-user" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="cursor: pointer;">
            @if(Auth::check())
            {{Auth::user()->nombres}}
            @endif
            <span id="user-image">
              <svg class="c-icon mfe-2">
                  <use xlink:href="{{asset('img/icons/user-fill.svg#i-user-fill')}}"></use>
                </svg>
            </span>
          </span>
          <div class="dropdown-menu dropdown-menu-right pt-0" aria-labelledby="btn-user">
            <div class="dropdown-header bg-light py-2"><strong>Cuenta</strong></div>
            <!-- <a class="dropdown-item" href="#">
              <svg class="c-icon mfe-2">
                <use xlink:href="{{asset('img/icons/bell.svg#bell')}}"></use>
              </svg> Updates<span class="badge badge-info mfs-auto">42</span>
            </a>
            <a class="dropdown-item" href="#">
              <svg class="c-icon mfe-2">
              <use xlink:href="{{asset('img/icons/envelope-open.svg#envelope-open')}}"></use>
              </svg> Messages<span class="badge badge-success mfs-auto">42</span>
            </a>
            <a class="dropdown-item" href="#">
              <svg class="c-icon mfe-2">
              <use xlink:href="{{asset('img/icons/task.svg#task')}}"></use>
              </svg> Tasks<span class="badge badge-danger mfs-auto">42</span>
            </a>
            <a class="dropdown-item" href="#">
              <svg class="c-icon mfe-2">
              <use xlink:href="{{asset('img/icons/comment-square.svg#comment-square')}}"></use>
              </svg> Comments<span class="badge badge-warning mfs-auto">42</span>
            </a>
            <div class="dropdown-header bg-light py-2"><strong>Settings</strong></div>
            <a class="dropdown-item" href="#">
              <svg class="c-icon mfe-2">
              <use xlink:href="{{asset('img/icons/user.svg#user')}}"></use>
              </svg> Profile
            </a>
            <a class="dropdown-item" href="#">
              <svg class="c-icon mfe-2">
              <use xlink:href="{{asset('img/icons/settings.svg#settings')}}"></use>
              </svg> Settings
            </a>
            <a class="dropdown-item" href="#">
              <svg class="c-icon mfe-2">
              <use xlink:href="{{asset('img/icons/credit-card.svg#credit-card')}}"></use>
              </svg> Payments<span class="badge badge-secondary mfs-auto">42</span>
            </a>
            <a class="dropdown-item" href="#">
              <svg class="c-icon mfe-2">
              <use xlink:href="{{asset('img/icons/file.svg#file')}}"></use>
              </svg> Projects<span class="badge badge-primary mfs-auto">42</span>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">
              <svg class="c-icon mfe-2">
              <use xlink:href="{{asset('img/icons/lock-locked.svg#lock-locked')}}"></use>
              </svg> Lock Account
            </a> -->
            <form action="{{ route('logout') }}" method="post" id="logout" class="d-none">{{csrf_field()}}</form>
            <button class="dropdown-item" type="submit" form="logout">
              <svg class="c-icon mfe-2">
              <use xlink:href="{{asset('img/icons/account-logout.svg#account-logout')}}"></use>
              </svg> Cerrar sesion
            </button>
          </div>
        </div>
      </div>
    </div>
  </nav>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark navbar2">
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
            <a class="nav-link {{ (request()->is('unidades') || request()->is('unidades/*')) ? 'active' : '' }}" href="{{route('unidades.lista')}}">Unidades</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ (request()->is('usuario') || request()->is('usuario/*')) ? 'active' : '' }}" href="{{route('usuario.index')}}">Usuarios</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ (request()->is('itemsgastos') || request()->is('itemsgastos/*')) ? 'active' : '' }}" href="{{route('itemsgastos.index')}}">Items de gasto</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ (request()->is('roles') || request()->is('roles/*')) ? 'active' : '' }}" href="{{route('roles.index')}}">Roles de usuario</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ (request()->is('solicitudes-de-items') || request()->is('solicitudes-de-items/*')) ? 'active' : '' }}" href="{{route('solicitudes-de-items.index')}}">Solicitudes de items</a>
          </li>
        </ul>

      </div>
    </div>
  </nav>

  <div class="main">
    @yield('main')
  </div>

  @yield('scripts')
  
</body>
</html>