<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
</head>
<body>

<!-- codigo importante -->

<div style="width:90%; margin:24px auto;">
  <h1>Registro de rol</h1>
  <br>
  <form action="/roles" method="post">
    {{csrf_field()}}

    <div class="mb-3">
      <label for="nombre" class="form-label">Nombre:</label>
      <input type="text" name="nombre_rol" id="nombre" value="{{old('nombre_rol')}}" class="form-control">
      @foreach($errors->get('nombre_rol') as $message)
      <div class="alert alert-danger" role="alert">{{$message}}</div>
      @endforeach
    </div>

    <label class="form-label">Permisos:</label>
    <div class="mb-3" style="width:60%; margin:auto;">
      <div class="row">
        <div class="col d-flex justify-content-center">Modulo</div>
        <div class="col d-flex justify-content-center">Visualizar</div>
        <div class="col d-flex justify-content-center">Crear</div>
        <div class="col d-flex justify-content-center">Editar</div>
      </div>
      <div>
        @foreach($modulos as $modulo)
        <div class="row">
          <div class="col">{{$modulo->modulo}}</div>
          <div class="col d-flex justify-content-center">
            <input type="checkbox" name="permisos[]" value="{{$modulo->visualizar_id}}" class="form-check-input" @if(is_array(old('permisos')) && in_array($modulo->visualizar_id, old('permisos'))) checked @endif>
          </div>
          <div class="col d-flex justify-content-center">
            <input type="checkbox" name="permisos[]" value="{{$modulo->crear_id}}" class="form-check-input" @if(is_array(old('permisos')) && in_array($modulo->crear_id, old('permisos'))) checked @endif>
          </div>
          <div class="col d-flex justify-content-center">
            <input type="checkbox" name="permisos[]" value="{{$modulo->editar_id}}" class="form-check-input" @if(is_array(old('permisos')) && in_array($modulo->editar_id, old('permisos'))) checked @endif>
          </div>
        </div>
        @endforeach
      </div>
      @foreach($errors->get('permisos') as $message)
      <div class="alert alert-danger" role="alert">{{$message}}</div>
      @endforeach
    </div>

    <button type="submit" class="btn btn-primary">REGISTRAR</button>
  </form>
</div>

<!-- fin codigo importante -->
  
</body>
</html>