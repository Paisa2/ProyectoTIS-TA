<ul class="c-header-nav">
  <li class="c-header-nav-item">
    <div class="dropdown">
      <span class="text-white" id="btn-user" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="cursor: pointer;">
        @if(Auth::check())
          {{Auth::user()->nombres}}
        @endif
      </span>
      <div class="dropdown-menu dropdown-menu-right pt-0" aria-labelledby="btn-user">
        <div class="dropdown-header bg-light py-2"><strong>Account</strong></div>
        <a class="dropdown-item" href="#">
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
        </a>
        <form action="{{ route('logout') }}" method="post" id="logout" class="d-none">{{csrf_field()}}</form>
        <button class="dropdown-item" type="submit" form="logout">
          <svg class="c-icon mfe-2">
          <use xlink:href="{{asset('img/icons/account-logout.svg#account-logout')}}"></use>
          </svg> Logout
        </button>
      </div>
    </div>
  </li>
  <button class="c-header-toggler c-class-toggler" type="button" data-target="#aside" data-class="c-sidebar-show">
    <svg class="c-icon c-icon-lg">
    <use xlink:href="{{asset('img/icons/applications-settings.svg#applications-settings')}}"></use>
    </svg>
  </button>
</ul>