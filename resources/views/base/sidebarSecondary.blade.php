<div class="c-sidebar c-sidebar-lg c-sidebar-light c-sidebar-right c-sidebar-overlaid" id="aside">
  <button class="c-sidebar-close" type="button" data-target="_parent" data-class="c-sidebar-show" responsive="true" id="close-sidebar">
    <svg class="c-icon">
      <use xlink:href="{{asset('img/icons/x.svg#x')}}"></use>
    </svg>
  </button>
  <ul class="nav nav-tabs nav-underline nav-underline-primary" role="tablist">
    <!-- <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#timeline" role="tab">
    <svg class="c-icon">
    <use xlink:href="{{asset('img/icons/list.svg#list')}}"></use>
    </svg></a></li> -->
    <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#messages" role="tab">
    <svg class="c-icon">
    <use xlink:href="{{asset('img/icons/bell.svg#bell')}}"></use>
    </svg></a></li>
    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#settings" role="tab">
    <svg class="c-icon">
    <use xlink:href="{{asset('img/icons/settings.svg#settings')}}"></use>
    </svg></a></li>
  </ul>

  <div class="tab-content">
    <!-- <div class="tab-pane active" id="timeline" role="tabpanel"></div> -->
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
  </div>
</div>