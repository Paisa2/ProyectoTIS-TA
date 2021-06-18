<div class="c-sidebar c-sidebar-lg c-sidebar-light c-sidebar-right c-sidebar-overlaid" id="aside">
  <button class="c-sidebar-close" type="button" data-target="_parent" data-class="c-sidebar-show" responsive="true" id="close-sidebar">
    <svg class="c-icon">
      <use xlink:href="{{asset('img/icons/x.svg#x')}}"></use>
    </svg>
  </button>
  <ul class="nav nav-tabs nav-underline nav-underline-primary" role="tablist">    
    <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#messages" role="tab">
    <svg class="c-icon">
    <use xlink:href="{{asset('img/icons/bell.svg#bell')}}"></use>
    </svg></a></li>
    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#settings" role="tab">
    <svg class="c-icon">
    <use xlink:href="{{asset('img/icons/settings.svg#settings')}}"></use>
    </svg></a></li>
    @if(session('rol') == 'Superusuario')
    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#links" role="tab">
    <svg class="c-icon">
    <use xlink:href="{{asset('img/icons/list.svg#i-list')}}"></use>
    </svg></a></li>
    @endif
    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#accounts" role="tab">
    <svg class="c-icon">
    <use xlink:href="{{asset('img/icons/bug.svg#i-bug')}}"></use>
    </svg></a></li>
  </ul>

  <div class="tab-content" style="overflow-y:auto;">
    <div class="tab-pane p-3 active" id="messages" role="tabpanel">
      @foreach($notificaciones as $notificacion)
      <div class="message">
        <div>
          <!-- <small class="text-muted">Lukasz Holeczek</small> -->
          <small class="text-muted float-right mt-1">{{$notificacion->created_at}}</small>
        </div>
        <div class="text-truncate font-weight-bold"><a class="aside-link" href="#">{{$notificacion->tipo_solicitud . " " . $notificacion->codigo}}</a></div>
        <small class="text-muted">
          {{$notificacion->mensaje_notificacion}}
        </small>
      </div>
      <hr>
      @endforeach
    </div>
    <div class="tab-pane p-3" id="settings" role="tabpanel">
      <h6>Configuraciones</h6>
      <div class="c-aside-options">
        <div class="clearfix mt-4"><small><b>Modo Oscuro</b></small>
        <label class="c-switch c-switch-label c-switch-pill c-switch-success c-switch-sm float-right" id="mode-dark">
          <input class="c-switch-input" type="checkbox" checked>
          <span class="c-switch-slider" data-checked="On" data-unchecked="Off"></span>
        </label>
        </div>
        <!-- <div><small class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</small></div> -->
      </div>
      <div class="c-aside-options">
        <div class="clearfix mt-4"><small><b>Barra de navegacion vertical</b></small>
        <label class="c-switch c-switch-label c-switch-pill c-switch-success c-switch-sm float-right" id="navbar-vertical">
          <input class="c-switch-input" type="checkbox" checked>
          <span class="c-switch-slider" data-checked="On" data-unchecked="Off"></span>
        </label>
        </div>
      </div>
      <div class="c-aside-options">
        <div class="clearfix mt-4"><small><b>Fondo con imagen</b></small>
        <label class="c-switch c-switch-label c-switch-pill c-switch-success c-switch-sm float-right" id="bg-image">
          <input class="c-switch-input" type="checkbox" checked>
          <span class="c-switch-slider" data-checked="On" data-unchecked="Off"></span>
        </label>
        </div>
      </div>
      <!-- <div class="c-aside-options">
        <div class="clearfix mt-3"><small><b>Option 2</b></small>
        <label class="c-switch c-switch-label c-switch-pill c-switch-success c-switch-sm float-right">
        <input class="c-switch-input" type="checkbox"><span class="c-switch-slider" data-checked="On" data-unchecked="Off"></span>
        </label>
        </div>
        <div><small class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</small></div>
      </div>
      <div class="c-aside-options">
        <div class="clearfix mt-3"><small><b>Option 3</b></small>
        <label class="c-switch c-switch-label c-switch-pill c-switch-success c-switch-sm float-right">
        <input class="c-switch-input" type="checkbox"><span class="c-switch-slider" data-checked="On" data-unchecked="Off"></span>
        </label>
        </div>
      </div>
      <div class="c-aside-options">
        <div class="clearfix mt-3"><small><b>Option 4</b></small>
          <label class="c-switch c-switch-label c-switch-pill c-switch-success c-switch-sm float-right">
          <input class="c-switch-input" type="checkbox" checked=""><span class="c-switch-slider" data-checked="On" data-unchecked="Off"></span>
          </label>
        </div>
      </div> -->
    </div>
    @if(session('rol') == 'Superusuario')
    <div class="tab-pane c-sidebar-nav ps" id="links" role="tabpanel">
      @if(session()->has('Visualizar solicitud de items') && session('rol') == 'Superusuario')
      <li class="c-sidebar-nav-item">
        <a class="c-sidebar-nav-link {{ (request()->is('solicitudes-de-items') || request()->is('solicitudes-de-items/*')) ? 'c-active' : '' }}" 
        href="{{route('solicitudes-de-items.index')}}">Solicitudes de items</a>
      </li>
      @endif
      @if(session()->has('Visualizar solicitud de adquisicion') && session('rol') == 'Superusuario')
      <li class="c-sidebar-nav-item">
        <a class="c-sidebar-nav-link {{ (request()->is('lista') || request()->is('lista/*')) ? 'c-active' : '' }}" 
        href="{{route('lista.index')}}">Solicitudes de adquisicion</a>
      </li>
      @endif
      @if(session()->has('Visualizar solicitud de cotizacion') && session('rol') == 'Superusuario')
      <li class="c-sidebar-nav-item">
        <a class="c-sidebar-nav-link {{ (request()->is('solicitudCotizacion') || request()->is('solicitudCotizacion/*')) || (request()->is('comparativo') || request()->is('comparativo/*')) || (request()->is('respuestasCotizacion') || request()->is('respuestasCotizacion/*')) ? 'c-active' : '' }}" 
        href="{{route('solicitudCotizacion.index')}}">Solicitudes de cotizacion</a>
      </li>
      @endif
    </div>
    @endif
    <div class="tab-pane p-3" id="accounts" role="tabpanel">
      <h6>Institucion</h6>
      <hr>
      <div class="c-aside-options">
        <div class="clearfix mt-4">
          <small><b>Superusuario</b></small>
        </div>
        <div><small class="text-muted"><a href="{{session('id')==1? '#' : route('login.access', 1)}}">Harry Potter</a></small></div>
      </div>
      <hr>
      <h6>Laboratorio de Fisica</h6>
      <hr>
      <div class="c-aside-options">
        <div class="clearfix mt-4">
          <small><b>Jefe unidad de gasto</b></small>
        </div>
        <div><small class="text-muted"><a href="{{session('id')==23? '#' : route('login.access', 23)}}">Gustavo Adolfo Domingo</a></small></div>
      </div>
      <hr>
      <h6>Unidad administrativa FCYT</h6>
      <hr>
      <div class="c-aside-options">
        <div class="clearfix mt-4">
          <small><b>Jefe de unidad administrativa</b></small>
        </div>
        <div><small class="text-muted"><a href="{{session('id')==21? '#' : route('login.access', 21)}}">Marco Antonio Rivera</a></small></div>
      </div>
      <div class="c-aside-options">
        <div class="clearfix mt-4">
          <small><b>Presupuestador</b></small>
        </div>
        <div><small class="text-muted"><a href="{{session('id')==22? '#' : route('login.access', 22)}}">Erick Montero</a></small></div>
      </div>
      <div class="c-aside-options">
        <div class="clearfix mt-4">
          <small><b>Cotizador</b></small>
        </div>
        <div><small class="text-muted"><a href="{{session('id')==24? '#' : route('login.access', 24)}}">Clemente Vazquez</a></small></div>
      </div>
      <hr>
      <h6>Biblioteca FCE</h6>
      <hr>
      <div class="c-aside-options">
        <div class="clearfix mt-4">
          <small><b>Jefe unidad de gasto</b></small>
        </div>
        <div><small class="text-muted"><a href="{{session('id')==28? '#' : route('login.access', 28)}}">Victor Jose Granados</a></small></div>
      </div>
      <hr>
      <h6>Unidad administrativa FCE</h6>
      <hr>
      <div class="c-aside-options">
        <div class="clearfix mt-4">
          <small><b>Jefe de unidad administrativa</b></small>
        </div>
        <div><small class="text-muted"><a href="{{session('id')==25? '#' : route('login.access', 25)}}">Armando Perez</a></small></div>
      </div>
      <div class="c-aside-options">
        <div class="clearfix mt-4">
          <small><b>Presupuestador</b></small>
        </div>
        <div><small class="text-muted"><a href="{{session('id')==29? '#' : route('login.access', 29)}}">Roberto Carlos Navarro</a></small></div>
      </div>
      <div class="c-aside-options">
        <div class="clearfix mt-4">
          <small><b>Cotizador</b></small>
        </div>
        <div><small class="text-muted"><a href="{{session('id')==31? '#' : route('login.access', 31)}}">Tomas Hinojosa</a></small></div>
      </div>
    </div>
  </div>
</div>