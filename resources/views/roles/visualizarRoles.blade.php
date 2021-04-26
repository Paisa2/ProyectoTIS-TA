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

  <h1>Roles Registrados</h1>
  <br>
  <div style="display:flex;justify-content:flex-end;">
    <a href="{{url('roles/create')}}" class="btn btn-primary">+Nuevo</a>
  </div>
  <table class="table">
    <thead>
      <tr>
        <th scope="col">Nro</th>
        <th scope="col">Rol</th>
        <th scope="col">Numero de permisos</th>
        <th scope="col">Fecha creacion</th>
      </tr>
    </thead>
    <tbody>
    @foreach($roles as $rol)
      <tr>
        <th scope="row">{{$loop->index +1}}</th>
        <td>{{$rol->nombre_rol}}</td>
        <td>{{$rol->numero_permisos}}</td>
        <td>{{$rol->created_at}}</td>
      </tr>
    @endforeach
    </tbody>
  </table>

</div>

<!-- fin codigo importante -->

</body>
</html>