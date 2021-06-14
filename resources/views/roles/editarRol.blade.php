@extends('base')

@section('head')
<link rel="stylesheet" href="{{ asset('css/forms.css') }}">
<link rel="stylesheet" href="{{ asset('css/tables.css') }}">
<link rel="stylesheet" href="{{ asset('css/roles/tableRol.css') }}">
@endsection

@section('main')
<!-- codigo importante -->

<div class="container-table">
  <form action="{{ route('roles.update', $rol->id) }}" method="post">
    {{csrf_field()}}
    {{method_field('put')}}
    <h1 class="display-4">Editar rol</h1>
    <br>
    <div class="mb-3">
      <label for="nombre" class="form-label">Nombre:</label>
      <input type="text" name="nombre_rol" class="form-control" autocomplete="off" 
      id="nombre" value="{{old('nombre_rol')?old('nombre_rol'):$rol->nombre_rol}}">
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
          <th>Eliminar</th>
        </tr>
      </thead>
      <tbody>
        @foreach($modulos as $modulo)
        <tr>
          <td class="module">{{$modulo->modulo}}</td>
          <td>
            <input type="checkbox" name="permisos[]" class="form-check-input" id="r-{{$loop->index +1}}" 
            @if($modulo->visualizar_id) checked value="1-{{$modulo->permiso_r_id}}"
            @else value="0-{{$modulo->permiso_r_id}}" @endif
            @if($modulo->crear_id || $modulo->editar_id || $modulo->eliminar_id) disabled @endif
            @if(is_array(old('permisos')) && in_array($modulo->visualizar_id, old('permisos'))) checked @endif>
          </td>
          <td>           
            <input type="checkbox" name="permisos[]" class="form-check-input" id="c-{{$loop->index +1}}"            
            @if($modulo->crear_id) checked value="1-{{$modulo->permiso_c_id}}" 
            @else value="0-{{$modulo->permiso_c_id}}" @endif
            @if(is_array(old('permisos')) && in_array($modulo->crear_id, old('permisos'))) checked @endif>
          </td>
          <td>
            <input type="checkbox" name="permisos[]" class="form-check-input" id="u-{{$loop->index +1}}" 
            @if($modulo->editar_id) checked value="1-{{$modulo->permiso_u_id}}" 
            @else value="0-{{$modulo->permiso_u_id}}" @endif
            @if(is_array(old('permisos')) && in_array($modulo->editar_id, old('permisos'))) checked @endif>
          </td>
          <td>
            <input type="checkbox" name="permisos[]" class="form-check-input" id="d-{{$loop->index +1}}" 
            @if($modulo->eliminar_id) checked value="1-{{$modulo->permiso_d_id}}"
            @else value="0-{{$modulo->permiso_d_id}}" @endif
            @if(is_array(old('permisos')) && in_array($modulo->eliminar_id, old('permisos'))) checked @endif>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
    @foreach($errors->get('permisos') as $message)
    <div class="alert alert-danger" role="alert">{{$message}}</div>
    @endforeach

    <div class="d-flex justify-content-center">
      <button id="guardar" type="submit" class="btn btn-primary">Guardar</button>
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
          if (tipo == "c" || tipo == "u" || tipo == "d") {
            if (!($("#r-"+num).is(":checked"))) $("#r-"+num).prop("checked", true);
            $("#r-"+num).prop("disabled", true);
          }
        } else {
          if (tipo == "c" || tipo == "u" || tipo == "d") {
            if (!($("#c-"+num).is(":checked")) && !($("#u-"+num).is(":checked")) && !($("#d-"+num).is(":checked"))) {
              $("#r-"+num).prop("disabled", false);
            }
          }
        }
      });
      $("#guardar").on("focus", function(){
        checkboxes.prop("disabled",false);
      });
    });
  </script>

@endsection