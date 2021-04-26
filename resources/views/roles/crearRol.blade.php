<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>

<!-- codigo importante -->

<h2>Crear Rol</h2>
<br>
<form action="/roles" method="post">
  {{csrf_field()}}

  <div>
    <label for="nombre">Nombre</label>
    <input type="text" name="nombre_rol" id="nombre" value="{{old('nombre_rol')}}">
    @foreach($errors->get('nombre_rol') as $message)
    <div style="color:red;">{{$message}}</div>
    @endforeach
  </div>
  <div style="width:600px;">
    <div style="display:flex;justify-content:space-between;width:auto;">
      <div>Modulo</div>
      <div>Visualizar</div>
      <div>Crear</div>
      <div>Editar</div>
    </div>
    <div>
      @foreach($modulos as $modulo)
      <div style="display:flex;justify-content:space-between;width:auto;">
        <div>{{$modulo->modulo}}</div>
        <input type="checkbox" name="permisos[]" value="{{$modulo->visualizar_id}}" @if(is_array(old('permisos')) && in_array($modulo->visualizar_id, old('permisos'))) checked @endif>
        <input type="checkbox" name="permisos[]" value="{{$modulo->crear_id}}" @if(is_array(old('permisos')) && in_array($modulo->crear_id, old('permisos'))) checked @endif>
        <input type="checkbox" name="permisos[]" value="{{$modulo->editar_id}}" @if(is_array(old('permisos')) && in_array($modulo->editar_id, old('permisos'))) checked @endif>
      </div>
      @endforeach
    </div>
    @foreach($errors->get('permisos') as $message)
    <div style="color:red;">{{$message}}</div>
    @endforeach
  </div>

  <button type="submit">Registrar</button>
</form>

<!-- fin codigo importante -->
  
</body>
</html>