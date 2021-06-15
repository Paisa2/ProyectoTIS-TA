<header class="c-header" id="c-header">
  <button class="c-header-toggler c-class-toggler d-lg-none mfe-auto d-none" type="button" data-target="#sidebar"
    data-class="c-sidebar-show">
    <svg class="c-icon c-icon-lg">
      <use xlink:href="{{asset('img/icons/menu.svg#menu')}}"></use>
    </svg>
  </button>
  <button class="c-header-toggler c-class-toggler mfs-3 d-md-down-none d-none" type="button" data-target="#sidebar"
    data-class="c-sidebar-lg-show" responsive="true">
    <svg class="c-icon c-icon-lg">
      <use xlink:href="{{asset('img/icons/menu.svg#menu')}}"></use>
    </svg>
  </button>
  <a class="navbar-brand" href="{{route('bienvenido')}}">CotySoft</a>
  @include('base.utilities')

  <div class="c-subheader justify-content-between px-3 d-none" id="c-subheader">
    <ol class="breadcrumb border-0 m-0 px-0 px-md-3">
      <li class="breadcrumb-item">Home</li>
      <li class="breadcrumb-item"><a href="#">Admin</a></li>
      <li class="breadcrumb-item active">Dashboard</li>
    </ol>
  </div>
</header>