@extends('base')

@section('head')
  <link rel="stylesheet" href="{{ asset('css/tables.css') }}">
@endsection

@section('main')
  
<!-- codigo importante -->
@if(session()->has('success'))
  <div class="alert alert-success" role="alert" id="success">
    {{ session()->get('success') }}
  </div>
  <script>setTimeout("document.getElementById('success').classList.add('d-none');",3000);</script>
@endif
@if(session()->has('error'))
  <div class="alert alert-danger" role="alert" id="error">
    {{ session()->get('error') }}
  </div>
  <script>setTimeout("document.getElementById('error').classList.add('d-none');",3000);</script>
@endif
@if(session()->has('exception'))
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <p>
      {{ session()->get('exception') }}
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
  </p>
    <hr>
    <p>Nota: Para proteger la integridad de la información y evitar perdida de datos, 
      un Rol de usuario no podra ser eliminado mientras este asignado a un usuario.</p>
  </div>
@endif

<div class="container-table">

  <h1 class="display-4">Roles Registrados</h1>
  @if(session()->has('Crear rol'))
  <div class="d-flex justify-content-end mb-3">
    <a href="{{ route('roles.create') }}" class="btn btn-primary">+ Nuevo</a>
  </div>
  @else
  <br><br>
  @endif
  <div class="table-responsive">
    <table class="table">
      <thead>
        <tr>
          <th class="options text-center">NRO</th>
          <th>ROL</th>
          <th class="text-center">NÚMERO DE PERMISOS</th>
          <th class="text-center">FECHA DE CREACIÓN</th>
          <th class="options"></th>
        </tr>
      </thead>
      <tbody>
      @foreach($roles as $rol)
        <tr>
          <td scope="row" class="text-center">{{$loop->index +1}}</td>
          <td>{{$rol->nombre_rol}}</td>
          <td class="text-center">{{$rol->numero_permisos}}</td>
          <td class="text-center">{{date("Y-m-d",strtotime($rol->created_at))}}</td>
          <td>
            <div class="dropdown dropleft">
              <span id="dd-options{{$loop->index +1}}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <svg class="c-icon mfe-2">
                  <use xlink:href="{{asset('img/icons/options.svg#i-options')}}"></use>
                </svg>
              </span>
              <div class="dropdown-menu" aria-labelledby="dd-options{{$loop->index +1}}">
                <div class="dropdown-header bg-light py-2"><strong>Opciones</strong></div>
                <a class="dropdown-item" href="{{ route('roles.show', $rol->id) }}">
                  <svg class="c-icon mfe-2">
                    <use xlink:href="{{asset('img/icons/details.svg#i-details')}}"></use>
                  </svg>Detalles
                </a>
                @if(session()->has('Editar rol') && $rol->nombre_rol != 'Superusuario')
                <a class="dropdown-item" type="submit" href="{{ route('roles.edit', $rol->id) }}">
                  <svg class="c-icon mfe-2">
                    <use xlink:href="{{asset('img/icons/edit.svg#i-edit')}}"></use>
                  </svg>Editar
                </a>
                @endif
                @if(session()->has('Eliminar rol') && $rol->nombre_rol != 'Superusuario')
                <form action="{{ route('roles.destroy', $rol->id) }}" method="post" class="d-none" id="delete{{$loop->index +1}}">{{ csrf_field() }}{{ method_field('delete') }}</form>
                <button class="dropdown-item" type="submit" form="delete{{$loop->index +1}}">
                  <svg class="c-icon mfe-2">
                    <use xlink:href="{{asset('img/icons/trash.svg#i-trash')}}"></use>
                  </svg>Eliminar
                </button>
                @endif
              </div>
            </div>
          </td>
        </tr>
      @endforeach
      </tbody>
    </table>
  </div>

</div>

<!-- fin codigo importante -->

@endsection