<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <title>Items de Gasto</title>
  </head>
  <body>
    <div class="container my-4">
       <h1 class="display-4">
        Items de Gasto Registrados
       </h1>
          <div style="display:flex;justify-content:flex-end;">
          <a class="btn btn-primary" href="{{url('itemsgastos/create')}}" role="button">+ Nuevo</a>
          </div>
       <table class="table">
  <thead>
    <tr>
      <th scope="col">NRO. ID</th>
      <th scope="col">TIPO</th>
      <th scope="col">NOMBRE</th>
      <th scope="col">PERTENECE A</th>
      <th scope="col">DETALLE DE REGISTRO</th>
    </tr>
  </thead>
  <tbody>
  @foreach($itemsgastos as $itemgasto)
    <tr>
      <th scope="row">{{ $loop->index +1}}</th>
      <th>{{$itemgasto->tipo_item}}</th>
      <th>{{$itemgasto->nombre_item}}</th>
      <th>{{$itemgasto->pertenece_a}}</th>
      <th>{{$itemgasto->created_at}}</th>
    </tr>
  @endforeach
  </tbody>
</table>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
    -->
  </body>
</html>