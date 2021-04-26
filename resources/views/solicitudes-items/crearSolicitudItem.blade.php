<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
  <style>
    textarea {
      resize: none;
    }
  </style>
</head>
<body>

<!-- codigo importante -->
<div style="width:90%; margin:24px auto;">
  <h1>Solicitar registro de items</h1>

  <form action="/solicitudes-de-items" method="post">
      {{csrf_field()}}
    <div class="mb-3">
      <label for="para" class="form-label">Para:</label>
      <select name="para_usuario_id" id="para" class="form-select">
        @foreach($destinatarios as $destinatario)
        <option value="{{$destinatario->id}}">{{$destinatario->nombres}} / {{$destinatario->nombre_rol}} / {{$destinatario->nombre_unidad}}</option>
        @endforeach
      </select>
      @foreach($errors->get('para_usuario_id') as $message)
      <div class="alert alert-danger" role="alert">{{$message}}</div>
      @endforeach
    </div>

    <div class="mb-3">
      <label for="solicitud" class="form-label">Solicitud</label>
      <br>
      <textarea name="detalle_solicitud_item" id="solicitud" class="form-control" rows="10"></textarea>
      @foreach($errors->get('detalle_solicitud_item') as $message)
      <div class="alert alert-danger" role="alert">{{$message}}</div>
      @endforeach
    </div>  

    <button type="submit" class="btn btn-primary">ENVIAR</button>
      
  </form>
</div>
<!-- fin codigo importante -->
  
</body>
</html>