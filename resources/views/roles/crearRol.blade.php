@extends('base')

@section('head')
<link rel="stylesheet" href="{{ asset('css/forms.css') }}">
<link rel="stylesheet" href="{{ asset('css/tables.css') }}">
<link rel="stylesheet" href="{{ asset('css/roles/tableRol.css') }}">
@endsection

@section('main')
<!-- codigo importante -->

<div style="width:70%; margin:48px auto;">
  <form action="{{ route('roles.store') }}" method="post">
    {{csrf_field()}}
    <h1 class="display-4">Registro de rol</h1>
    <br>

    <div class="mb-3">
      <label for="nombre" class="form-label">Nombre:</label>
      <input type="text" name="nombre_rol" id="nombre" value="{{old('nombre_rol')}}" class="form-control" autocomplete="off">
      @foreach($errors->get('nombre_rol') as $message)
      <div class="alert alert-danger" role="alert">{{$message}}</div>
      @endforeach
    </div>

    <label class="form-label">Permisos:</label>
    <table class="table">
      <thead>
        <tr>
          <th>Modulo</th>
          <th>Visualizar</th>
          <th>Crear</th>
          <th>Editar</th>
        </tr>
      </thead>
      <tbody>
        @foreach($modulos as $modulo)
        <tr>
          <td class="module">{{$modulo->modulo}}</td>
          <td>
            <input type="checkbox" name="permisos[]" value="{{$modulo->visualizar_id}}" id="r-{{$loop->index +1}}" class="form-check-input" @if(is_array(old('permisos')) && in_array($modulo->visualizar_id, old('permisos'))) checked @endif>
          </td>
          <td>
            <input type="checkbox" name="permisos[]" value="{{$modulo->crear_id}}" id="c-{{$loop->index +1}}" class="form-check-input" @if(is_array(old('permisos')) && in_array($modulo->crear_id, old('permisos'))) checked @endif>
          </td>
          <td>
            <input type="checkbox" name="permisos[]" value="{{$modulo->editar_id}}" id="u-{{$loop->index +1}}" class="form-check-input" @if(is_array(old('permisos')) && in_array($modulo->editar_id, old('permisos'))) checked @endif>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
    @foreach($errors->get('permisos') as $message)
    <div class="alert alert-danger" role="alert">{{$message}}</div>
    @endforeach

    <div class="d-flex justify-content-center">
      <button type="submit" class="btn btn-primary" id="registrar">REGISTRAR</button>
    </div>
    
  </form>
</div>

<!-- fin codigo importante -->
@endsection

@section('scripts')
  <script>
    $(document).ready(function(){
      let checkboxes = $("input[type='checkbox']");
      checkboxes.change(function(){
        let id = $(this).attr("id");
        let tipo = id.charAt(0);
        let num = id.charAt(id.length-1);
        if ($(this).is(":checked")) {
          if (tipo == "c" || tipo == "u") {
            if (!($("#r-"+num).is(":checked"))) $("#r-"+num).prop("checked", true);
            $("#r-"+num).prop("disabled", true);
          }
        } else {
          if (tipo == "c" || tipo == "u") {
            if (!($("#c-"+num).is(":checked")) && !($("#u-"+num).is(":checked"))) {
            $("#r-"+num).prop("disabled", false);
          }
        }
      });
      $("#registrar").on("focus", function(){
        checkboxes.prop("disabled", false);
      });
    });
  </script>
@endsection