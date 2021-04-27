<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
</head>
<body>

<!-- codigo importante -->

<div class="container my-4">

<h2>Usuarios Registrados</h2>

  <table class="table">

      <div style="display:flex;justify-content:flex-end;">
        <a class="btn btn-primary" href="{{url('usuario/create')}}">Nuevo</a>
      </div>
      <thead>
        <tr>
          <th scope="col">Número</th>
          <th scope="col">Nombres</th>
          <th scope="col">Apellidos</th>
          <th scope="col">Rol</th>
          <th scope="col">Email</th>
          <th scope="col">Pertenece a</th>
          <th scope="col">Fecha creación</th>
        </tr>
      </thead>
      @foreach($usuarios as $usuario)
      <tbody>
        <tr>
          <td>{{ $loop->index +1 }}</td>
          <td>{{$usuario->nombres}}</td>
          <td>{{$usuario->apellidos}}</td>
          <td>{{$usuario->nombre_rol}}</td>
          <td>{{$usuario->email}}</td>
          <td>{{$usuario->nombre_unidad}}</td>
          <td>{{$usuario->created_at}}</td>
        </tr>
      </tbody>
      @endforeach


  </table>

</div>

<!-- fin codigo importante -->

</body>
</html>