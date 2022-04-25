@extends('base')

@section('head')
  <link rel="stylesheet" href="{{ asset('css/tables.css') }}">
  <link rel="stylesheet" href="{{ asset('css/roles/tableRol.css') }}">
@endsection

@section('main')

<div style="width:70%" class="container-table">
  <h1 class="display-4">{{$rol->nombre_rol}}</h1>
  <br>
  <label class="form-label">Permisos:</label>
    <div class="table-responsive">
      <table class="table">
        <thead>
          <tr>
            <th>Modulo</th>
            <th>Visualizar</th>
            <th>Crear</th>
            <th>Editar</th>
            <th>Eliminar</th>
          </tr>
        </thead>
        <tbody>
          @foreach($modulos as $modulo)
          <tr>
            <td class="module">{{$modulo->modulo}}</td>
            <td>
              <svg class="c-icon mfe-2">
                @if($modulo->visualizar)
                <use xlink:href="{{asset('img/icons/checked.svg#i-checked')}}"></use>
                @else
                <use xlink:href="{{asset('img/icons/unchecked.svg#i-unchecked')}}"></use>
                @endif
              </svg>
            </td>
            <td>
              <svg class="c-icon mfe-2">
                @if($modulo->crear)
                <use xlink:href="{{asset('img/icons/checked.svg#i-checked')}}"></use>
                @else
                <use xlink:href="{{asset('img/icons/unchecked.svg#i-unchecked')}}"></use>
                @endif
              </svg>
            </td>
            <td>
              <svg class="c-icon mfe-2">
                @if($modulo->editar)
                <use xlink:href="{{asset('img/icons/checked.svg#i-checked')}}"></use>
                @else
                <use xlink:href="{{asset('img/icons/unchecked.svg#i-unchecked')}}"></use>
                @endif
              </svg>
            </td>
            <td>
              <svg class="c-icon mfe-2">
                @if($modulo->eliminar)
                <use xlink:href="{{asset('img/icons/checked.svg#i-checked')}}"></use>
                @else
                <use xlink:href="{{asset('img/icons/unchecked.svg#i-unchecked')}}"></use>
                @endif
              </svg>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
</div>

@endsection